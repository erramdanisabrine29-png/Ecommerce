<x-layouts.app>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $product->product_name }}</h1>
            <p class="text-gray-600 mt-2">Reference: <code class="bg-gray-100 px-2 py-1 rounded">{{ $product->reference }}</code></p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('products.edit', $product) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded transition">
                Edit
            </a>
            <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure?')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Description</h2>
                <p class="text-gray-700">
                    {{ $product->description ?? 'No description provided' }}
                </p>
            </div>

            <!-- Pricing -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Pricing</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-blue-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Price HT</p>
                        <p class="text-2xl font-bold text-blue-600">€{{ number_format($product->price_excl_tax, 2) }}</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Tax Rate</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $product->tax }}%</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded">
                        <p class="text-gray-600 text-sm">Price TTC</p>
                        <p class="text-2xl font-bold text-green-600">€{{ number_format($product->price_incl_tax, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Stock Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Stock Management</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">Available Stock</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $product->available_stock }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Safety Stock</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $product->safety_stock }}</p>
                    </div>
                </div>
                
                @if($product->isLowStock())
                    <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded">
                        <span class="text-red-700 font-medium">⚠️ Low Stock Alert - Consider reordering</span>
                    </div>
                @endif

                <div class="mt-4 p-3 bg-gray-50 rounded">
                    <p class="text-gray-600 text-sm">Unit</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $product->unit }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Sales Statistics -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Sales Statistics</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded">
                        <span class="text-gray-600">Units Sold</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $product->sales_count }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-purple-50 rounded">
                        <span class="text-gray-600">Page Views</span>
                        <span class="text-2xl font-bold text-purple-600">{{ $product->views_count }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-yellow-50 rounded">
                        <span class="text-gray-600">Average Rating</span>
                        <span class="text-2xl font-bold text-yellow-500">{{ number_format($product->average_rating, 1) }}★</span>
                    </div>

                    @if($product->views_count > 0)
                        <div class="p-3 bg-green-50 rounded">
                            <p class="text-gray-600 text-sm mb-1">Conversion Rate</p>
                            <p class="text-2xl font-bold text-green-600">{{ number_format($product->getConversionRate(), 1) }}%</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Details</h2>
                
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600">Created:</p>
                        <p class="text-gray-900 font-medium">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Last Updated:</p>
                        <p class="text-gray-900 font-medium">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
            ← Back to Products
        </a>
    </div>
</div>
</x-layouts.app>
