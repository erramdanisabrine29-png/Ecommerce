<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display products web page for merchant.
     * GET /products
     */
    public function indexWeb()
    {
        $user = Auth::user();
        
        // Get merchant ID from the merchants table
        $merchant = Merchant::where('user_id', $user->id)->first();
        
        // Create merchant if it doesn't exist
        if (!$merchant) {
            $merchant = Merchant::create([
                'user_id' => $user->id,
                'company_name' => $user->name . ' Store',
                'siret' => '00000000000000',
                'country' => 'France',
                'currency' => 'EUR',
                'balance' => 0,
                'sale_rate' => 0.05,
                'average_rating' => 0,
            ]);
        }
        
        $merchantId = $merchant->id_merchant;
        
        // Get all products for this merchant
        $products = Product::where('id_merchant', $merchantId)
            ->paginate(20);

        return view('products.index', [
            'products' => $products,
            'merchant' => $merchant,
            'user' => $user,
        ]);
    }

    /**
     * Display products web page for a specific store.
     * GET /stores/{store}/products
     */
    public function indexWebByStore(Store $store)
    {
        // ensure the authenticated merchant owns this store
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $products = $store->products()->paginate(20);

        return view('products.index', [
            'products' => $products,
            'store' => $store,
        ]);
    }

    /**
     * List all products for a merchant's store.
     * GET /api/stores/{store}/products
     */
    public function index(Store $store)
    {
        // Ensure merchant owns this store
        if ($store->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $products = $store->products()
            ->paginate(20);

        return response()->json($products);
    }

    /**
     * Create a new product.
     * POST /api/stores/{store}/products
     */
    public function store(Request $request, Store $store)
    {
        // Ensure merchant owns this store
        if ($store->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate(Product::rules());

        // resolve merchant for this store's owner
        $merchant = Merchant::where('user_id', $store->user_id)->first();
        if (! $merchant) {
            return response()->json(['error' => 'Merchant not found for this store'], 422);
        }

        $validated['id_merchant'] = $merchant->id_merchant;

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    /**
     * Get a specific product.
     * GET /api/products/{product}
     */
    public function show(Product $product)
    {
        // Ensure merchant owns this product (use merchant->user_id)
        if ($product->merchant->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($product);
    }

    /**
     * Update a product.
     * PUT /api/products/{product}
     */
    public function update(Request $request, Product $product)
    {
        // Ensure merchant owns this product (use merchant->user_id)
        if ($product->merchant->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(Product::rules($product->id_product));
        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }

    /**
     * Delete a product.
     * DELETE /api/products/{product}
     */
    public function destroy(Product $product)
    {
        // Ensure merchant owns this product (use merchant->user_id)
        if ($product->merchant->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }

    /**
     * Decrement stock for a product.
     * POST /api/products/{product}/decrement-stock
     */
    public function decrementStock(Request $request, Product $product)
    {
        // Ensure merchant owns this product (use merchant->user_id)
        if ($product->merchant->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if (! $product->isInStock($validated['quantity'])) {
            return response()->json([
                'error' => 'Insufficient stock',
                'available' => $product->available_stock,
                'requested' => $validated['quantity'],
            ], 400);
        }

        $product->decrementStock($validated['quantity']);

        return response()->json([
            'message' => 'Stock decremented successfully',
            'product' => $product,
            'is_low_stock' => $product->isLowStock(),
        ]);
    }

    /**
     * Increment stock for a product.
     * POST /api/products/{product}/increment-stock
     */
    public function incrementStock(Request $request, Product $product)
    {
        // Ensure merchant owns this product (use merchant->user_id)
        if ($product->merchant->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product->incrementStock($validated['quantity']);

        return response()->json([
            'message' => 'Stock incremented successfully',
            'product' => $product,
        ]);
    }

    /**
     * Get product statistics.
     * GET /api/products/{product}/stats
     */
    public function getStats(Product $product)
    {
        // Ensure merchant owns this product
        if ($product->merchant->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'product_id' => $product->id_product,
            'name' => $product->product_name,
            'stock' => $product->available_stock,
            'is_low_stock' => $product->isLowStock(),
            'price_ht' => $product->price_excl_tax,
            'price_ttc' => $product->getPriceWithTax(),
            'tax_amount' => $product->getTaxAmount(),
            'statistics' => [
                'total_sold' => $product->sales_count ?? 0,
                'total_revenue' => ($product->sales_count * $product->price_incl_tax) ?? 0,
                'total_views' => $product->views_count ?? 0,
                'sales_count' => $product->sales_count ?? 0,
                'conversion_rate' => $product->getConversionRate(),
                'average_sale_price' => $product->getAverageSalePrice(),
            ],
        ]);
    }

    /**
     * Record a product view.
     * POST /api/products/{product}/record-view
     */
    public function recordView(Product $product)
    {
        $product->recordView();

        return response()->json([
            'message' => 'View recorded',
            'views' => $product->views_count ?? 1,
        ]);
    }

    /**
     * Get low stock products for a store.
     * GET /api/stores/{store}/products/low-stock
     */
    public function getLowStockProducts(Store $store)
    {
        // Ensure merchant owns this store
        if ($store->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lowStockProducts = $store->products()
            ->whereColumn('available_stock', '<=', 'safety_stock')
            ->get();

        return response()->json([
            'store_id' => $store->id,
            'low_stock_count' => $lowStockProducts->count(),
            'products' => $lowStockProducts->map(function ($product) {
                return [
                    'id' => $product->id_product,
                    'name' => $product->product_name,
                    'stock' => $product->available_stock,
                    'safety_stock' => $product->safety_stock,
                ];
            }),
        ]);
    }

    /**
     * Show create product form.
     * GET /products/create
     */
    public function createWeb()
    {
        return view('products.create');
    }

    /**
     * Store a new product in database.
     * POST /products
     */
    public function storeWeb(Request $request)
    {
        $user = Auth::user();
        $merchant = Merchant::where('user_id', $user->id)->first();
        
        // Create merchant if it doesn't exist
        if (!$merchant) {
            $merchant = Merchant::create([
                'user_id' => $user->id,
                'company_name' => $user->name . ' Store',
                'siret' => '00000000000000',
                'country' => 'France',
                'currency' => 'EUR',
                'balance' => 0,
                'sale_rate' => 0.05,
                'average_rating' => 0,
            ]);
        }

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'reference' => 'required|string|unique:products,reference',
            'price_excl_tax' => 'required|numeric|min:0.01',
            'price_incl_tax' => 'required|numeric|min:0.01',
            'tax' => 'required|numeric|min:0|max:100',
            'unit' => 'required|string|max:50',
            'available_stock' => 'required|integer|min:0',
            'safety_stock' => 'required|integer|min:0',
            'specifications' => 'nullable|json',
            'images' => 'nullable|json',
        ]);

        $validated['id_merchant'] = $merchant->id_merchant;

        $product = Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show product details.
     * GET /products/{product}
     */
    public function showWeb(Product $product)
    {
        // Verify merchant owns this product
        $user = Auth::user();
        $merchant = Merchant::where('user_id', $user->id)->first();

        if ($product->id_merchant !== $merchant->id_merchant) {
            abort(403, 'Unauthorized');
        }

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show edit product form.
     * GET /products/{product}/edit
     */
    public function editWeb(Product $product)
    {
        // Verify merchant owns this product
        $user = Auth::user();
        $merchant = Merchant::where('user_id', $user->id)->first();

        if ($product->id_merchant !== $merchant->id_merchant) {
            abort(403, 'Unauthorized');
        }

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update product.
     * PUT /products/{product}
     */
    public function updateWeb(Request $request, Product $product)
    {
        // Verify merchant owns this product
        $user = Auth::user();
        $merchant = Merchant::where('user_id', $user->id)->first();

        if ($product->id_merchant !== $merchant->id_merchant) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'reference' => 'required|string|unique:products,reference,' . $product->id_product . ',id_product',
            'price_excl_tax' => 'required|numeric|min:0.01',
            'price_incl_tax' => 'required|numeric|min:0.01',
            'tax' => 'required|numeric|min:0|max:100',
            'unit' => 'required|string|max:50',
            'available_stock' => 'required|integer|min:0',
            'safety_stock' => 'required|integer|min:0',
            'specifications' => 'nullable|json',
            'images' => 'nullable|json',
        ]);

        $product->update($validated);

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product.
     * DELETE /products/{product}
     */
    public function destroyWeb(Product $product)
    {
        // Verify merchant owns this product
        $user = Auth::user();
        $merchant = Merchant::where('user_id', $user->id)->first();

        if ($product->id_merchant !== $merchant->id_merchant) {
            abort(403, 'Unauthorized');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
