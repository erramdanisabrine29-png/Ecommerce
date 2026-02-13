<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Order {{ $order->reference }}</h1>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Shipping Amount</label>
                <input name="shipping_amount" value="{{ old('shipping_amount', $order->shipping_amount) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Discount</label>
                <input name="discount" value="{{ old('discount', $order->discount) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="order_status" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm">
                @foreach(['pending','confirmed','preparing','shipped','delivered','cancelled','returned'] as $s)
                    <option value="{{ $s }}" {{ $order->order_status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-6 flex gap-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            <a href="{{ route('orders.show', $order) }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Cancel</a>
        </div>
    </form>
</div>
</x-layouts.app>
