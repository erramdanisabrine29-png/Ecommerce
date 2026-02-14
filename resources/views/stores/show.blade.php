<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <flux:heading size="xl">{{ $store->name }}</flux:heading>
            <flux:button :href="route('stores.index')" variant="ghost" wire:navigate>← {{ __('Back') }}</flux:button>
        </div>

        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif

        <flux:card class="mb-6">
            <flux:heading size="lg" class="mb-4">{{ __('Store details') }}</flux:heading>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">{{ __('Name') }}</p>
                    <p class="font-medium text-zinc-800 dark:text-zinc-200">{{ $store->name }}</p>
                </div>
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">{{ __('URL') }}</p>
                    <p class="font-medium"><a href="{{ $store->url }}" target="_blank" rel="noopener" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $store->url }}</a></p>
                </div>
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">{{ __('Tax rate') }}</p>
                    <p class="font-medium text-zinc-800 dark:text-zinc-200">{{ $store->tax_rate }}%</p>
                </div>
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">{{ __('Minimum stock') }}</p>
                    <p class="font-medium text-zinc-800 dark:text-zinc-200">{{ $store->minimum_stock }}</p>
                </div>
            </div>
        </flux:card>

        <flux:card class="mb-6">
            <flux:heading size="lg" class="mb-4">{{ __('SSL certificate') }}</flux:heading>
            <div class="flex items-center gap-3">
                <flux:badge :color="$store->ssl_certificate_status === 'active' ? 'green' : ($store->ssl_certificate_status === 'expired' ? 'red' : 'yellow')">
                    {{ ucfirst($store->ssl_certificate_status) }}
                </flux:badge>
                @if($store->ssl_certificate_status !== 'active')
                    <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Certificate not active') }}</span>
                @else
                    <span class="text-sm text-green-600 dark:text-green-400">{{ __('Valid certificate') }}</span>
                @endif
            </div>
        </flux:card>

        <flux:card class="mb-6">
            <flux:heading size="lg" class="mb-4">{{ __('API key') }}</flux:heading>
            <div class="flex items-center gap-3 mb-4">
                <code class="flex-1 bg-zinc-100 dark:bg-white/10 px-4 py-3 rounded font-mono text-sm overflow-auto">{{ $store->api_key }}</code>
                <flux:button type="button" variant="primary" data-copy="{{ $store->api_key }}" onclick="navigator.clipboard.writeText(this.getAttribute('data-copy')).then(()=>alert('{{ __('API key copied') }}'))">{{ __('Copy') }}</flux:button>
            </div>
            <form action="{{ route('stores.regenerateApiKey', $store) }}" method="POST" onsubmit="return confirm('{{ __('Regenerate API key? The old key will stop working.') }}');">
                @csrf
                <flux:button type="submit" variant="danger" size="sm">{{ __('Regenerate API key') }}</flux:button>
            </form>
        </flux:card>

        <div class="text-sm text-zinc-500 dark:text-zinc-400 border-t border-zinc-200 dark:border-white/10 pt-4">
            <p>{{ __('Created at') }} {{ $store->created_at->format('d/m/Y H:i') }}</p>
            <p>{{ __('Updated at') }} {{ $store->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="flex gap-3 mt-6">
            @can('stores.update')
            <flux:button :href="route('stores.edit', $store)" variant="outline" wire:navigate>{{ __('Edit') }}</flux:button>
            @endcan
            @can('stores.delete')
            <form action="{{ route('stores.destroy', $store) }}" method="POST" onsubmit="return confirm('{{ __('Delete this store?') }}');">
                @csrf
                @method('DELETE')
                <flux:button type="submit" variant="danger">{{ __('Delete') }}</flux:button>
            </form>
            @endcan
        </div>
    </div>
</x-app-layout>
