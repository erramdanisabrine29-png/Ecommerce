<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Site;
use App\Models\Customer;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Get order status workflow (API)
     */
    public function statusWorkflow()
    {
        $workflow = \App\Services\OrderStatusWorkflow::workflow();
        $diagram = \App\Services\OrderStatusWorkflow::diagram();
        $finals = \App\Services\OrderStatusWorkflow::FINAL_STATUSES;

        return response()->json([
            'workflow' => $workflow,
            'diagram' => $diagram,
            'final_states' => $finals,
        ]);
    }

    /**
     * Change order status with validation and logging (API)
     */
    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = $request->user();
        $newStatus = $request->input('status');
        $note = $request->input('note');
        $workflow = \App\Services\OrderStatusWorkflow::workflow();
        $oldStatus = $order->order_status;

        // Role-based restriction
        if ($user->hasRole('employee') && !in_array($newStatus, ['NO ANSWER', 'BUSY', 'CALL LATER', 'CANCELLED'])) {
            return response()->json(['error' => 'Employees can only set certain statuses.'], 403);
        }

        // Validate transition
        if (!isset($workflow[$oldStatus]) || !in_array($newStatus, $workflow[$oldStatus])) {
            return response()->json(['error' => 'Invalid status transition.'], 422);
        }

        DB::transaction(function () use ($order, $oldStatus, $newStatus, $user, $note) {
            $order->order_status = $newStatus;
            $order->save();
            OrderStatusHistory::logStatusChange($order->id_order, $oldStatus, $newStatus, $user->id, $note);
        });

        return response()->json(['success' => true, 'order' => $order]);
    }

    /**
     * Create a new order (API)
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

        // Authorization
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
                'total_amount' => 0,
            ]);

            $linesTotal = 0;

            foreach ($data['lines'] as $line) {
                $product = Product::findOrFail($line['product_id']);

                if (!$product->isInStock($line['quantity'])) {
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

                if (!$product->decrementStock($line['quantity'])) {
                    throw new \Exception("Failed to decrement stock for product id {$product->id_product}");
                }

                $linesTotal += $totalPrice;
            }

            $order->total_amount = round($linesTotal + ($order->shipping_amount ?? 0) - ($order->discount ?? 0), 2);
            $order->save();

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
     * List orders for authenticated merchant (API)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $orders = Order::whereHas('statusHistory', function ($q) use ($user) {
            $q->whereNotNull('id');
        })->paginate(20);

        return response()->json($orders);
    }

    /**
     * Show single order (API)
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('lines.product', 'statusHistory');
        return response()->json($order);
    }

    /* ---------------- Web (Blade) methods ---------------- */

    /**
     * List orders page (Web)
     */
    public function indexWeb()
    {
        $orders = Order::with('lines.product', 'statusHistory')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show create order form (Web)
     */
    public function createWeb()
    {
        $sites = Site::orderBy('id_site')->get();
        $customers = Customer::orderBy('id_customer')->get();

        return view('orders.create', [
            'sites' => $sites,
            'customers' => $customers,
        ]);
    }

    /**
     * Store order from web form
     */
    public function storeWeb(Request $request)
    {
        // Validation and customer creation logic...
        // ثم delegate إلى $this->store($request);
        return $this->store($request);
    }

    /**
     * Show order page (Web)
     */
    public function showWeb(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('lines.product', 'statusHistory');
        return view('orders.show', ['order' => $order]);
    }

    /**
     * Edit order page (Web)
     */
    public function editWeb(Order $order)
    {
        $this->authorize('update', $order);
        $order->load('lines.product', 'statusHistory');
        return view('orders.edit', ['order' => $order]);
    }

    /**
     * Update order (Web)
     */
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
            if (isset($data['shipping_amount'])) $order->shipping_amount = $data['shipping_amount'];
            if (isset($data['discount'])) $order->discount = $data['discount'];
            $order->save();

            if (!empty($data['order_status']) && $data['order_status'] !== $order->order_status) {
                $this->changeStatus(new Request(['status' => $data['order_status'], 'note' => 'Updated via web UI']), $order->id_order);
            }

            DB::commit();
            return redirect()->route('orders.show', $order)->with('success', 'Order updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete order (Web)
     */
    public function destroyWeb(Order $order)
    {
        $this->authorize('delete', $order);
        DB::beginTransaction();
        try {
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
