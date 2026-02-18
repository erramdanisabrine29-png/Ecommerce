<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $store->name }}</h1>

            <div class="flex gap-2">
                <a href="{{ route('stores.applications', $store->id) }}"
                   class="btn btn-lg px-4 py-2 fw-semibold shadow-sm"
                   style="
                       background: linear-gradient(135deg, #ff512f, #dd2476);
                       border: none;
                       border-radius: 12px;
                       color: white;
                       transition: all 0.3s ease;
                   "
                   onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)'"
                   onmouseout="this.style.transform='none';this.style.boxShadow='0 2px 6px rgba(0,0,0,0.1)'"
                >
                    <i class="bi bi-grid-fill me-2"></i>
                    Applications
                </a>

                <a href="{{ route('stores.index') }}" class="text-gray-600 hover:text-gray-900">← Retour</a>
            </div>
        </div>

        <!-- Success message -->
        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif

        <!-- Store details -->
        <div class="bg-white rounded-lg shadow-md p-8 space-y-6">

            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations du magasin</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">Nom</p>
                        <p class="text-lg font-medium text-gray-900">{{ $store->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">URL</p>
                        <p class="text-lg font-medium">
                            <a href="{{ $store->url }}" target="_blank" class="text-blue-600 hover:underline">{{ $store->url }}</a>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Taux de TVA</p>
                        <p class="text-lg font-medium text-gray-900">{{ $store->tax_rate }}%</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Stock minimum</p>
                        <p class="text-lg font-medium text-gray-900">{{ $store->minimum_stock }} unités</p>
                    </div>
                </div>
            </div>

            <!-- SSL certificate -->
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

            <!-- API key -->
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

            <!-- Created / Updated -->
            <div class="text-sm text-zinc-500 dark:text-zinc-400 border-t border-zinc-200 dark:border-white/10 pt-4">
                <p>{{ __('Created at') }} {{ $store->created_at->format('d/m/Y H:i') }}</p>
                <p>{{ __('Updated at') }} {{ $store->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4 border-t">
                @can('stores.update')
                    <a href="{{ route('stores.edit', $store) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-center">
                        Éditer
                    </a>
                @endcan

                @can('stores.delete')
                    <form action="{{ route('stores.destroy', $store) }}" method="POST" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Supprimer
                        </button>
                    </form>
                @endcan
            </div>

        </div>
    </div>
</x-app-layout>
