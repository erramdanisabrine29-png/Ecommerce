<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            @if(isset($store))
                <h1 class="text-3xl font-bold text-gray-900">Produits — {{ $store->name }}</h1>
                <p class="text-gray-600 mt-2">Produits associés au magasin «{{ $store->name }}»</p>
            @else
                <h1 class="text-3xl font-bold text-gray-900">Products Management</h1>
                <p class="text-gray-600 mt-2">Manage your products and inventory</p>
            @endif
        </div>
        <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded transition">
            + Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <div class="p-6">
                        <!-- Product Header -->
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $product->product_name }}
                        </h2>

                        <!-- Price Information -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Price HT:</span>
                                <span class="text-lg font-bold text-blue-600">
                                    €{{ number_format($product->price_excl_tax, 2) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Price TTC:</span>
                                <span class="text-lg font-bold text-green-600">
                                    €{{ number_format($product->price_incl_tax, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Stock Information -->
                        <div class="mb-4 p-3 rounded bg-gray-50">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-medium">Stock:</span>
                                <span class="text-lg font-bold">{{ $product->available_stock }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Safety Stock:</span>
                                <span class="text-sm">{{ $product->safety_stock }}</span>
                            </div>
                            @if($product->isLowStock())
                                <div class="mt-2 p-2 bg-red-50 rounded border border-red-200">
                                    <span class="text-red-700 text-sm font-medium">⚠️ Low Stock Alert</span>
                                </div>
                            @endif
                        </div>

                        <!-- Sales Statistics -->
                        <div class="mb-4 p-3 rounded bg-gray-50">
                            <div class="grid grid-cols-3 gap-2 text-center">
                                <div>
                                    <span class="text-gray-600 text-xs">Sold</span>
                                    <div class="text-lg font-bold text-gray-900">{{ $product->sales_count }}</div>
                                </div>
                                <div>
                                    <span class="text-gray-600 text-xs">Views</span>
                                    <div class="text-lg font-bold text-gray-900">{{ $product->views_count }}</div>
                                </div>
                                <div>
                                    <span class="text-gray-600 text-xs">Rating</span>
                                    <div class="text-lg font-bold text-yellow-500">{{ number_format($product->average_rating, 1) }}★</div>
                                </div>
                            </div>
                            @if($product->views_count > 0)
                                <div class="mt-2 text-center">
                                    <span class="text-xs text-gray-600">
                                        Conversion: {{ number_format($product->getConversionRate(), 1) }}%
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($product->description, 100) }}
                        </p>

                        <!-- Reference -->
                        <div class="mb-4 text-sm text-gray-500">
                            Ref: <code class="bg-gray-100 px-2 py-1 rounded">{{ $product->reference }}</code>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('products.show', $product) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition text-center text-sm">
                                View
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded transition text-center text-sm">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" style="flex: 1;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
            <p class="text-yellow-800 font-medium">No products found</p>
            <p class="text-yellow-700 text-sm mt-1">
                <a href="{{ route('products.create') }}" class="text-blue-600 hover:text-blue-700 font-medium">Create your first product</a> to get started
            </p>
        </div>
    @endif
</div>
</x-layouts.app>
