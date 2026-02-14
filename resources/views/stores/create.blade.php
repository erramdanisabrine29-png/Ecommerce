<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Create store') }}</flux:heading>

        <flux:card class="max-w-2xl">
            <form action="{{ route('stores.store') }}" method="POST" class="space-y-6">
                @csrf

                <flux:input name="name" type="text" :label="__('Store name')" :value="old('name')" placeholder="e.g. My Tech Store" required />
                <flux:input name="url" type="url" :label="__('Site URL')" :value="old('url')" placeholder="https://example.com" required />

                <flux:select name="ssl_certificate_status" :label="__('SSL certificate status')" required>
                    <option value="">{{ __('Select') }}</option>
                    <option value="active" @selected(old('ssl_certificate_status') === 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(old('ssl_certificate_status') === 'inactive')>{{ __('Inactive') }}</option>
                    <option value="expired" @selected(old('ssl_certificate_status') === 'expired')>{{ __('Expired') }}</option>
                    <option value="pending" @selected(old('ssl_certificate_status') === 'pending')>{{ __('Pending') }}</option>
                </flux:select>

                <flux:input name="tax_rate" type="number" :label="__('Tax rate (%)')" :value="old('tax_rate')" step="0.01" min="0" max="100" placeholder="19.00" required />
                <flux:input name="minimum_stock" type="number" :label="__('Minimum stock')" :value="old('minimum_stock')" min="1" placeholder="10" required />
                <flux:input name="api_key" type="text" :label="__('API key (optional)')" :value="old('api_key')" :description="__('Leave empty to auto-generate')" />

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Create store') }}</flux:button>
                    <flux:button :href="route('stores.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-app-layout>
