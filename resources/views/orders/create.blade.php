<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Create Order</h1>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Site</label>
                <select name="id_site" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="">-- select site --</option>
                    @foreach($sites as $s)
                        <option value="{{ $s->id_site }}" {{ old('id_site') == $s->id_site ? 'selected' : '' }}>{{ $s->site_name ?? "Site #{$s->id_site}" }}</option>
                    @endforeach
                </select>
                @error('id_site')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Customer (free text)</label>
                <input name="customer_text" value="{{ old('customer_text') }}" placeholder="Customer name or identifier" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                @error('customer_text')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Shipping Amount</label>
                <input name="shipping_amount" value="{{ old('shipping_amount', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Discount</label>
                <input name="discount" value="{{ old('discount', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
        </div>

        <hr class="my-6" />

        <h3 class="font-semibold mb-2">Order Lines (single-line UI for now)</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Product ID</label>
                <input name="lines[0][product_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input name="lines[0][quantity]" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Unit price</label>
                <input name="lines[0][unit_price]" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
            </div>
        </div>

        <div class="flex gap-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Order</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Cancel</a>
        </div>
    </form>
</div>
</x-layouts.app>
