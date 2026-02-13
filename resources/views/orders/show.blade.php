<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold">Order {{ $order->reference }}</h1>
            <p class="text-sm text-gray-500">Status: <strong>{{ ucfirst($order->order_status) }}</strong></p>
        </div>
        <div class="text-right">
            <p class="text-sm">Total: <span class="font-semibold">€{{ number_format($order->total_amount,2) }}</span></p>
            <p class="text-sm">Shipping: €{{ number_format($order->shipping_amount ?? 0,2) }}</p>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 mb-6">
        <h3 class="font-semibold mb-2">Lines</h3>
        <div class="space-y-2">
            @foreach($order->lines as $line)
                <div class="flex justify-between border-b pb-2">
                    <div>
                        <div class="font-medium">{{ $line->order_product_name ?? ('#'.$line->id_product) }}</div>
                        <div class="text-xs text-gray-500">Ref: {{ $line->order_product_reference }}</div>
                    </div>
                    <div class="text-right">
                        <div>{{ $line->quantity }} × €{{ number_format($line->unit_price,2) }}</div>
                        <div class="font-semibold">€{{ number_format($line->total_price,2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 mb-6">
        <h3 class="font-semibold mb-2">Status history</h3>
        <ul class="text-sm space-y-2">
            @foreach($order->statusHistory as $h)
                <li class="border p-2 rounded">
                    <div><strong>{{ ucfirst($h->new_status) }}</strong> — {{ $h->created_at->diffForHumans() }}</div>
                    @if($h->note)<div class="text-xs text-gray-500">{{ $h->note }}</div>@endif
                </li>
            @endforeach
        </ul>
    </div>

    <div class="flex gap-2">
        <a href="{{ route('orders.edit', $order) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a>
        <a href="{{ route('orders.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>
</div>
</x-layouts.app>
