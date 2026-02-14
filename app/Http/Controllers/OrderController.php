<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\Site;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new order (transactional).
     * Accepts: id_site, id_customer, shipping_amount, discount, lines: [{product_id, quantity, unit_price, discount}]
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_site' => 'required|integer|exists:sites,id_site',
            'id_customer' => 'required|integer|exists:customers,id_customer',
            'shipping_amount' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'lines' => 'required|array|min:1',
            'lines.*.product_id' => 'required|integer|exists:products,id_product',
            'lines.*.quantity' => 'required|integer|min:1',
            'lines.*.unit_price' => 'required|numeric|min:0',
            'lines.*.discount' => 'nullable|numeric|min:0',
        ]);

        $userId = Auth::id() ?? null;

        // Authorization: ensure the authenticated user can create an order for the target site
        $site = Site::findOrFail($data['id_site']);
        $this->authorize('create', $site);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'id_site' => $data['id_site'],
                'id_customer' => $data['id_customer'],
                'reference' => 'ORD-' . strtoupper(uniqid()),
                'order_status' => 'pending',
                'shipping_amount' => $data['shipping_amount'] ?? 0,
                'discount' => $data['discount'] ?? 0,
                // DB requires a non-null total_amount on insert — initialize to 0 and recalc later
                'total_amount' => 0,
            ]);

            $linesTotal = 0;

            foreach ($data['lines'] as $line) {
                $product = Product::findOrFail($line['product_id']);

                // Check stock
                if (! $product->isInStock($line['quantity'])) {
                    throw new \Exception("Insufficient stock for product id {$product->id_product}");
                }

                $unitPrice = $line['unit_price'];
                $discount = $line['discount'] ?? 0;
                $totalPrice = round(($unitPrice * $line['quantity']) - $discount, 2);

                $orderLine = $order->lines()->create([
                    'id_product' => $product->id_product,
                    'quantity' => $line['quantity'],
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'discount' => $discount,
                    'order_product_reference' => $product->reference ?? null,
                    'order_product_name' => $product->product_name ?? null,
                    'order_product_specs' => $product->specifications ?? null,
                ]);

                // Deduct stock
                if (! $product->decrementStock($line['quantity'])) {
                    throw new \Exception("Failed to decrement stock for product id {$product->id_product}");
                }

                $linesTotal += $totalPrice;
            }

            // set computed total_amount
            $order->total_amount = round($linesTotal + ($order->shipping_amount ?? 0) - ($order->discount ?? 0), 2);
            $order->save();

            // initial status history
            OrderStatusHistory::create([
                'id_order' => $order->id_order,
                'old_status' => null,
                'new_status' => 'pending',
                'changed_by' => $userId,
                'note' => 'Order created',
            ]);

            DB::commit();

            return response()->json(['message' => 'Order created', 'order' => $order], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Update order status and log history. Restores stock on cancel/return.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,confirmed,preparing,shipped,delivered,cancelled,returned',
            'note' => 'nullable|string',
        ]);

        $this->authorize('update', $order);

        DB::beginTransaction();
        try {
            $old = $order->order_status;
            $order->order_status = $data['status'];
            $order->save();

            OrderStatusHistory::create([
                'id_order' => $order->id_order,
                'old_status' => $old,
                'new_status' => $data['status'],
                'changed_by' => Auth::id(),
                'note' => $data['note'] ?? null,
            ]);

            // restore stock if cancelled or returned
            if (in_array($data['status'], ['cancelled', 'returned'])) {
                foreach ($order->lines as $line) {
                    $product = $line->product;
                    if ($product) {
                        $product->incrementStock($line->quantity);
                    }
                }
            }

            DB::commit();

            return response()->json(['message' => 'Status updated']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * List orders for authenticated merchant (site owner).
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $orders = Order::whereHas('statusHistory', function ($q) use ($user) {
            // placeholder — merchants will filter by site ownership in real app
            $q->whereNotNull('id');
        })->paginate(20);

        return response()->json($orders);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('lines.product', 'statusHistory');
        return response()->json($order);
    }

    /* ---------------------- Web (Blade) methods ---------------------- */

    public function indexWeb()
    {
        $orders = Order::with('lines.product', 'statusHistory')->orderByDesc('created_at')->paginate(20);
        return view('orders.index', ['orders' => $orders]);
    }

    public function createWeb()
    {
        // Provide lists for site and customer selects so validation can't be missed by the user.
        $sites = \App\Models\Site::orderBy('id_site')->get();
        $customers = \App\Models\Customer::orderBy('id_customer')->get();

        return view('orders.create', [
            'sites' => $sites,
            'customers' => $customers,
        ]);
    }

    public function storeWeb(Request $request)
    {
        // Allow web users to provide a free-text customer name OR choose an existing customer id.
        $request->validate([
            'id_site' => 'required|integer|exists:sites,id_site',
            'id_customer' => 'nullable|integer|exists:customers,id_customer',
            'customer_text' => 'nullable|string|max:191|required_without:id_customer',
            'shipping_amount' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'lines' => 'required|array|min:1',
            'lines.*.product_id' => 'required|integer|exists:products,id_product',
            'lines.*.quantity' => 'required|integer|min:1',
            'lines.*.unit_price' => 'required|numeric|min:0',
        ]);

        // If user provided a free-text customer, create or find a Customer record.
        if (! $request->filled('id_customer') && $request->filled('customer_text')) {
            $name = trim($request->input('customer_text'));
            // Simple split for first/last name
            $parts = preg_split('/\s+/', $name, 2);
            $first = $parts[0] ?? $name;
            $last = $parts[1] ?? null;

            $emailSafe = strtolower(preg_replace('/[^a-z0-9]+/','.', ($first . '.' . ($last ?? ''))));
            $email = substr($emailSafe,0,50) . '+order@local.example';

            // Prefer the site owner (merchant user) for the customer.user_id FK, else fall back to the
            // authenticated user, else to admin user id 7 which exists in the dev DB.
            $siteOwnerUserId = null;
            try {
                $siteOwnerUserId = optional(\App\Models\Site::find($request->input('id_site')))->merchant->user_id ?? null;
            } catch (\Throwable $e) {
                $siteOwnerUserId = null;
            }

            $customerUserId = $siteOwnerUserId ?? (\Illuminate\Support\Facades\Auth::id() ?? 7);

            $customer = \App\Models\Customer::create([
                'user_id' => $customerUserId,
                'first_name_customer' => $first,
                'last_name_customer' => $last,
                'email' => $email,
            ]);

            // inject created customer id into request before delegating to store()
            $request->request->set('id_customer', $customer->id_customer);
        }

        $resp = $this->store($request);

        if ($resp instanceof \Illuminate\Http\JsonResponse && $resp->getStatusCode() === 201) {
            return redirect()->route('orders.index')->with('success', 'Order created successfully.');
        }

        $body = $resp instanceof \Illuminate\Http\JsonResponse ? $resp->getData(true) : null;
        $message = $body['error'] ?? 'Failed to create order.';
        return back()->withErrors(['form' => $message])->withInput();
    }

    public function showWeb(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('lines.product', 'statusHistory');
        return view('orders.show', ['order' => $order]);
    }

    public function editWeb(Order $order)
    {
        $this->authorize('update', $order);
        $order->load('lines.product', 'statusHistory');
        return view('orders.edit', ['order' => $order]);
    }

    public function updateWeb(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $data = $request->validate([
            'shipping_amount' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'order_status' => 'nullable|string|in:pending,confirmed,preparing,shipped,delivered,cancelled,returned',
        ]);

        DB::beginTransaction();
        try {
            if (isset($data['shipping_amount'])) {
                $order->shipping_amount = $data['shipping_amount'];
            }
            if (isset($data['discount'])) {
                $order->discount = $data['discount'];
            }
            $order->save();

            // status update path
            if (!empty($data['order_status']) && $data['order_status'] !== $order->order_status) {
                $this->updateStatus(new Request(['status' => $data['order_status'], 'note' => 'Updated via web UI']), $order);
            }

            $order->recalcTotals();

            DB::commit();
            return redirect()->route('orders.show', $order)->with('success', 'Order updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroyWeb(Order $order)
    {
        $this->authorize('delete', $order);

        DB::beginTransaction();
        try {
            // restore stock for lines
            foreach ($order->lines as $line) {
                $product = $line->product;
                if ($product) {
                    $product->incrementStock($line->quantity);
                }
            }

            $order->delete();
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order deleted.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
