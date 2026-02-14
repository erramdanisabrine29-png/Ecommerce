<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Create order') }}</flux:heading>

        @if(session('error'))
            <flux:card class="mb-6 !border-red-500 !bg-red-50 dark:!bg-red-950/30">
                <p class="text-red-700 dark:text-red-400 text-sm">{{ session('error') }}</p>
            </flux:card>
        @endif

        <flux:card class="max-w-3xl">
            <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:select name="id_site" :label="__('Site')" required>
                        <option value="">{{ __('Select site') }}</option>
                        @foreach($sites as $s)
                            <option value="{{ $s->id_site }}" @selected(old('id_site') == $s->id_site)>{{ $s->site_name ?? __('Site') . ' #' . $s->id_site }}</option>
                        @endforeach
                    </flux:select>
                    <flux:input name="customer_text" type="text" :label="__('Customer')" :value="old('customer_text')" placeholder="{{ __('Customer name or identifier') }}" required />
                    <flux:input name="shipping_amount" type="number" step="0.01" :label="__('Shipping amount')" :value="old('shipping_amount', 0)" />
                    <flux:input name="discount" type="number" step="0.01" :label="__('Discount')" :value="old('discount', 0)" />
                </div>

                <flux:heading size="lg" class="!mt-8">{{ __('Order lines') }}</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <flux:input name="lines[0][product_id]" type="text" :label="__('Product ID')" required />
                    <flux:input name="lines[0][quantity]" type="number" min="1" :label="__('Quantity')" :value="old('lines.0.quantity', 1)" required />
                    <flux:input name="lines[0][unit_price]" type="number" step="0.01" :label="__('Unit price')" required />
                </div>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Create order') }}</flux:button>
                    <flux:button :href="route('orders.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-app-layout>
