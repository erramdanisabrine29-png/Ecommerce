<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <flux:heading size="xl">{{ __('Order') }} {{ $order->reference }}</flux:heading>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">{{ __('Status') }}: <flux:badge color="zinc" size="sm">{{ ucfirst($order->order_status) }}</flux:badge></p>
            </div>
            <div class="text-end text-sm">
                <p class="font-semibold text-zinc-800 dark:text-zinc-200">€{{ number_format($order->total_amount, 2) }}</p>
                <p class="text-zinc-600 dark:text-zinc-400">{{ __('Shipping') }}: €{{ number_format($order->shipping_amount ?? 0, 2) }}</p>
            </div>
        </div>

        <flux:card class="mb-6">
            <flux:heading size="lg" class="mb-4">{{ __('Order lines') }}</flux:heading>
            <div class="space-y-4">
                @foreach($order->lines as $line)
                    <div class="flex justify-between items-start border-b border-zinc-200 dark:border-white/10 pb-4 last:border-0 last:pb-0">
                        <div>
                            <p class="font-medium text-zinc-800 dark:text-zinc-200">{{ $line->order_product_name ?? '#' . $line->id_product }}</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Ref') }}: {{ $line->order_product_reference }}</p>
                        </div>
                        <div class="text-end">
                            <p class="text-sm">{{ $line->quantity }} × €{{ number_format($line->unit_price, 2) }}</p>
                            <p class="font-semibold text-zinc-800 dark:text-zinc-200">€{{ number_format($line->total_price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </flux:card>

        <flux:card class="mb-6">
            <flux:heading size="lg" class="mb-4">{{ __('Status history') }}</flux:heading>
            <ul class="space-y-2 text-sm">
                @foreach($order->statusHistory as $h)
                    <li class="border border-zinc-200 dark:border-white/10 rounded-lg p-3">
                        <p class="font-medium text-zinc-800 dark:text-zinc-200">{{ ucfirst($h->new_status) }} — {{ $h->created_at->diffForHumans() }}</p>
                        @if($h->note)<p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">{{ $h->note }}</p>@endif
                    </li>
                @endforeach
            </ul>
        </flux:card>

        <div class="flex gap-3">
            @can('orders.update')
            <flux:button :href="route('orders.edit', $order)" variant="outline" wire:navigate>{{ __('Edit') }}</flux:button>
            @endcan
            <flux:button :href="route('orders.index')" variant="ghost" wire:navigate>{{ __('Back') }}</flux:button>
        </div>
    </div>
</x-app-layout>
