<x-layouts.app>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Mes Magasins</h1>
        <a href="{{ route('stores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Créer un magasin
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ $message }}
        </div>
    @endif

    @if ($stores->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($stores as $store)
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $store->name }}</h2>

                    <div class="space-y-3 mb-4 text-sm text-gray-700">
                        <p><strong>URL:</strong> <a href="{{ $store->url }}" target="_blank" class="text-blue-600 hover:underline">{{ $store->url }}</a></p>
                        <p><strong>SSL:</strong> 
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($store->ssl_certificate_status === 'active') bg-green-100 text-green-800
                                @elseif($store->ssl_certificate_status === 'expired') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($store->ssl_certificate_status) }}
                            </span>
                        </p>
                        <p><strong>TVA:</strong> {{ $store->tax_rate }}%</p>
                        <p><strong>Stock min:</strong> {{ $store->minimum_stock }} unités</p>
                    </div>

                    <div class="bg-gray-50 p-3 rounded mb-4 border border-gray-300">
                        <p class="text-xs text-gray-600 mb-1">Clé API</p>
                        <div class="flex items-center gap-2">
                            <code class="text-xs bg-gray-200 px-2 py-1 rounded flex-grow font-mono overflow-auto">{{ $store->api_key }}</code>
                            <button onclick="copyToClipboard('{{ $store->api_key }}')" class="text-blue-600 hover:text-blue-800 text-sm">
                                Copier
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('stores.show', $store) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded text-center text-sm">
                            Voir
                        </a>
                        <a href="{{ route('stores.products', $store) }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-3 rounded text-center text-sm">
                            Mes produits
                        </a>
                        <a href="{{ route('stores.edit', $store) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-3 rounded text-center text-sm">
                            Éditer
                        </a>
                        <form action="{{ route('stores.destroy', $store) }}" method="POST" class="flex-1" onsubmit="return confirm('Êtes-vous sûr?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded text-sm">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $stores->links() }}
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
            <p class="text-gray-700 mb-4">Vous n'avez aucun magasin.</p>
            <a href="{{ route('stores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Créer votre premier magasin
            </a>
        </div>
    @endif
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Clé API copiée!');
    });
}
</script>

</x-layouts.app>
