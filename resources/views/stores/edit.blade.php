<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Edit store') }}: {{ $store->name }}</flux:heading>

        <flux:card class="max-w-2xl">
            <form action="{{ route('stores.update', $store) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <flux:input name="name" type="text" :label="__('Store name')" :value="old('name', $store->name)" required />
                <flux:input name="url" type="url" :label="__('Site URL')" :value="old('url', $store->url)" required />

                <flux:select name="ssl_certificate_status" :label="__('SSL certificate status')" required>
                    <option value="active" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'inactive')>{{ __('Inactive') }}</option>
                    <option value="expired" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'expired')>{{ __('Expired') }}</option>
                    <option value="pending" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'pending')>{{ __('Pending') }}</option>
                </flux:select>

                <flux:input name="tax_rate" type="number" :label="__('Tax rate (%)')" :value="old('tax_rate', $store->tax_rate)" step="0.01" min="0" max="100" required />
                <flux:input name="minimum_stock" type="number" :label="__('Minimum stock')" :value="old('minimum_stock', $store->minimum_stock)" min="1" required />

                <flux:card class="!bg-blue-50 dark:!bg-blue-950/30 !border-blue-200 dark:!border-blue-800">
                    <p class="text-sm text-blue-800 dark:text-blue-200"><strong>{{ __('Current API key') }}:</strong> <code class="bg-blue-100 dark:bg-blue-900/50 px-2 py-1 rounded text-xs">{{ $store->api_key }}</code></p>
                    <p class="text-sm text-blue-700 dark:text-blue-300 mt-2">{{ __('To regenerate the API key, go to the store details page.') }}</p>
                </flux:card>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Update') }}</flux:button>
                    <flux:button :href="route('stores.show', $store)" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-app-layout>
