<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Edit order') }} {{ $order->reference }}</flux:heading>

        @if(session('error'))
            <flux:card class="mb-6 !border-red-500 !bg-red-50 dark:!bg-red-950/30">
                <p class="text-red-700 dark:text-red-400 text-sm">{{ session('error') }}</p>
            </flux:card>
        @endif

        <flux:card class="max-w-2xl">
            <form method="POST" action="{{ route('orders.update', $order) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input name="shipping_amount" type="number" step="0.01" :label="__('Shipping amount')" :value="old('shipping_amount', $order->shipping_amount)" />
                    <flux:input name="discount" type="number" step="0.01" :label="__('Discount')" :value="old('discount', $order->discount)" />
                </div>

                <flux:select name="order_status" :label="__('Status')">
                    @foreach(['pending','confirmed','preparing','shipped','delivered','cancelled','returned'] as $s)
                        <option value="{{ $s }}" @selected($order->order_status === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </flux:select>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Save') }}</flux:button>
                    <flux:button :href="route('orders.show', $order)" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-app-layout>
