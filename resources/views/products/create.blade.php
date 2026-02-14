<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-2">{{ __('Create product') }}</flux:heading>
        <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-6">{{ __('Add a new product to your catalog') }}</p>

        <flux:card class="max-w-2xl">
            <form method="POST" action="{{ route('products.store') }}" class="space-y-6" id="product-form">
                @csrf

                <flux:input name="product_name" type="text" :label="__('Product name')" :value="old('product_name')" required />
                <flux:input name="reference" type="text" :label="__('Reference')" :value="old('reference')" placeholder="e.g. PROD-001" required />
                <flux:textarea name="description" :label="__('Description')" rows="4">{{ old('description') }}</flux:textarea>

                <flux:heading size="md" class="!mt-6">{{ __('Pricing') }}</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input id="price_excl_tax" name="price_excl_tax" type="number" step="0.01" :label="__('Price ex. tax (€)')" :value="old('price_excl_tax')" required />
                    <flux:input id="tax" name="tax" type="number" step="0.01" min="0" max="100" :label="__('Tax rate (%)')" :value="old('tax', 20)" required />
                </div>
                <flux:input id="price_incl_tax" name="price_incl_tax" type="number" step="0.01" :label="__('Price inc. tax (€)')" :value="old('price_incl_tax')" required readonly />

                <flux:heading size="md" class="!mt-6">{{ __('Stock') }}</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input name="available_stock" type="number" min="0" :label="__('Available stock')" :value="old('available_stock', 0)" required />
                    <flux:input name="safety_stock" type="number" min="0" :label="__('Safety stock')" :value="old('safety_stock', 10)" required />
                </div>

                <flux:select name="unit" :label="__('Unit')" required>
                    <option value="">{{ __('Select unit') }}</option>
                    <option value="pcs" @selected(old('unit') === 'pcs')>{{ __('Piece(s)') }}</option>
                    <option value="kg" @selected(old('unit') === 'kg')>{{ __('Kilogram(s)') }}</option>
                    <option value="l" @selected(old('unit') === 'l')>{{ __('Liter(s)') }}</option>
                    <option value="m" @selected(old('unit') === 'm')>{{ __('Meter(s)') }}</option>
                    <option value="box" @selected(old('unit') === 'box')>{{ __('Box(es)') }}</option>
                </flux:select>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Create product') }}</flux:button>
                    <flux:button :href="route('products.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function calc() {
            var priceHT = parseFloat(document.getElementById('price_excl_tax')?.value) || 0;
            var taxRate = parseFloat(document.getElementById('tax')?.value) || 0;
            var priceTTC = priceHT * (1 + (taxRate / 100));
            var inc = document.getElementById('price_incl_tax');
            if (inc) inc.value = priceTTC.toFixed(2);
        }
        document.getElementById('price_excl_tax')?.addEventListener('input', calc);
        document.getElementById('tax')?.addEventListener('input', calc);
        calc();
    });
    </script>
</x-app-layout>
