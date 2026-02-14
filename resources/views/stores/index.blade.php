<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <flux:heading size="xl">{{ __('Stores') }}</flux:heading>
            @can('stores.create')
            <flux:button :href="route('stores.create')" variant="primary" wire:navigate>{{ __('Create store') }}</flux:button>
            @endcan
        </div>

        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif

        @if($stores->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($stores as $store)
                    <flux:card class="flex flex-col">
                        <flux:heading size="lg" class="mb-3">{{ $store->name }}</flux:heading>
                        <div class="space-y-2 text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                            <p><strong class="text-zinc-800 dark:text-zinc-200">{{ __('URL') }}:</strong> <a href="{{ $store->url }}" target="_blank" rel="noopener" class="text-blue-600 dark:text-blue-400 hover:underline">{{ Str::limit($store->url, 40) }}</a></p>
                            <p><strong class="text-zinc-800 dark:text-zinc-200">{{ __('SSL') }}:</strong>
                                <flux:badge :color="$store->ssl_certificate_status === 'active' ? 'green' : ($store->ssl_certificate_status === 'expired' ? 'red' : 'yellow')" size="sm">
                                    {{ ucfirst($store->ssl_certificate_status) }}
                                </flux:badge>
                            </p>
                            <p><strong class="text-zinc-800 dark:text-zinc-200">{{ __('Tax rate') }}:</strong> {{ $store->tax_rate }}%</p>
                            <p><strong class="text-zinc-800 dark:text-zinc-200">{{ __('Min. stock') }}:</strong> {{ $store->minimum_stock }}</p>
                        </div>
                        <div class="bg-zinc-100 dark:bg-white/10 p-3 rounded-lg mb-4">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-1">{{ __('API Key') }}</p>
                            <div class="flex items-center gap-2">
                                <code class="text-xs font-mono flex-1 truncate bg-zinc-200 dark:bg-white/10 px-2 py-1 rounded">{{ $store->api_key }}</code>
                                <flux:button type="button" size="sm" variant="ghost" data-copy="{{ $store->api_key }}" onclick="navigator.clipboard.writeText(this.getAttribute('data-copy')).then(()=>alert('{{ __('API key copied') }}'))">{{ __('Copy') }}</flux:button>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-auto">
                            <flux:button :href="route('stores.show', $store)" size="sm" variant="primary" wire:navigate>{{ __('View') }}</flux:button>
                            @can('stores.update')
                            <flux:button :href="route('stores.edit', $store)" size="sm" variant="outline" wire:navigate>{{ __('Edit') }}</flux:button>
                            @endcan
                            @can('stores.delete')
                            <form action="{{ route('stores.destroy', $store) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                @csrf
                                @method('DELETE')
                                <flux:button type="submit" size="sm" variant="danger">{{ __('Delete') }}</flux:button>
                            </form>
                            @endcan
                        </div>
                    </flux:card>
                @endforeach
            </div>
            <div class="mt-6">{{ $stores->links() }}</div>
        @else
            <flux:card class="text-center py-12">
                <flux:heading size="lg" class="mb-4">{{ __('No stores yet') }}</flux:heading>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6">{{ __('Create your first store to get started.') }}</p>
                @can('stores.create')
                <flux:button :href="route('stores.create')" variant="primary" wire:navigate>{{ __('Create store') }}</flux:button>
                @endcan
            </flux:card>
        @endif
    </div>
</x-app-layout>
