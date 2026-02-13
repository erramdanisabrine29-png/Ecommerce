<x-layouts.app>
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-gray-600 mt-2">Update product information</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="mb-6">
                <label for="product_name" class="block text-gray-700 font-medium mb-2">Product Name *</label>
                <input 
                    type="text" 
                    id="product_name" 
                    name="product_name" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('product_name') border-red-500 @enderror"
                    value="{{ old('product_name', $product->product_name) }}"
                    required
                >
                @error('product_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Reference -->
            <div class="mb-6">
                <label for="reference" class="block text-gray-700 font-medium mb-2">Reference *</label>
                <input 
                    type="text" 
                    id="reference" 
                    name="reference" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('reference') border-red-500 @enderror"
                    value="{{ old('reference', $product->reference) }}"
                    required
                >
                @error('reference')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror"
                >{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pricing Section -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pricing</h3>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="price_excl_tax" class="block text-gray-700 font-medium mb-2">Price HT (€) *</label>
                        <input 
                            type="number" 
                            id="price_excl_tax" 
                            name="price_excl_tax" 
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('price_excl_tax') border-red-500 @enderror"
                            value="{{ old('price_excl_tax', $product->price_excl_tax) }}"
                            required
                            onchange="calculatePrice()"
                        >
                        @error('price_excl_tax')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="tax" class="block text-gray-700 font-medium mb-2">Tax Rate (%) *</label>
                        <input 
                            type="number" 
                            id="tax" 
                            name="tax" 
                            step="0.01"
                            min="0"
                            max="100"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('tax') border-red-500 @enderror"
                            value="{{ old('tax', $product->tax) }}"
                            required
                            onchange="calculatePrice()"
                        >
                        @error('tax')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="price_incl_tax" class="block text-gray-700 font-medium mb-2">Price TTC (€) *</label>
                    <input 
                        type="number" 
                        id="price_incl_tax" 
                        name="price_incl_tax" 
                        step="0.01"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('price_incl_tax') border-red-500 @enderror"
                        value="{{ old('price_incl_tax', $product->price_incl_tax) }}"
                        required
                        readonly
                    >
                    @error('price_incl_tax')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Stock Section -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Stock Management</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="available_stock" class="block text-gray-700 font-medium mb-2">Available Stock *</label>
                        <input 
                            type="number" 
                            id="available_stock" 
                            name="available_stock" 
                            min="0"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('available_stock') border-red-500 @enderror"
                            value="{{ old('available_stock', $product->available_stock) }}"
                            required
                        >
                        @error('available_stock')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="safety_stock" class="block text-gray-700 font-medium mb-2">Safety Stock *</label>
                        <input 
                            type="number" 
                            id="safety_stock" 
                            name="safety_stock" 
                            min="0"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('safety_stock') border-red-500 @enderror"
                            value="{{ old('safety_stock', $product->safety_stock) }}"
                            required
                        >
                        @error('safety_stock')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Unit -->
            <div class="mb-6">
                <label for="unit" class="block text-gray-700 font-medium mb-2">Unit *</label>
                <select 
                    id="unit" 
                    name="unit"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('unit') border-red-500 @enderror"
                    required
                >
                    <option value="">Select unit</option>
                    <option value="pcs" {{ old('unit', $product->unit) === 'pcs' ? 'selected' : '' }}>Piece(s)</option>
                    <option value="kg" {{ old('unit', $product->unit) === 'kg' ? 'selected' : '' }}>Kilogram(s)</option>
                    <option value="l" {{ old('unit', $product->unit) === 'l' ? 'selected' : '' }}>Liter(s)</option>
                    <option value="m" {{ old('unit', $product->unit) === 'm' ? 'selected' : '' }}>Meter(s)</option>
                    <option value="box" {{ old('unit', $product->unit) === 'box' ? 'selected' : '' }}>Box(es)</option>
                </select>
                @error('unit')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <a href="{{ route('products.show', $product) }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded transition text-center">
                    Cancel
                </a>
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded transition">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function calculatePrice() {
    const priceHT = parseFloat(document.getElementById('price_excl_tax').value) || 0;
    const taxRate = parseFloat(document.getElementById('tax').value) || 0;
    const priceTTC = priceHT * (1 + (taxRate / 100));
    document.getElementById('price_incl_tax').value = priceTTC.toFixed(2);
}

// Calculate on page load
calculatePrice();
</script>
</x-layouts.app>
