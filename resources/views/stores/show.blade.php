<x-layouts.app>

<div class="container mx-auto px-4 py-8">
    
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $store->name }}</h1>
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

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ $message }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8 space-y-6">
           

            <!-- Basic Info -->
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

            <!-- SSL Status -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Certificat SSL</h2>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 rounded text-sm font-semibold
                        @if($store->ssl_certificate_status === 'active') bg-green-100 text-green-800
                        @elseif($store->ssl_certificate_status === 'expired') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($store->ssl_certificate_status) }}
                    </span>
                    @if($store->ssl_certificate_status !== 'active')
                        <p class="text-sm text-gray-600">⚠️ Attention : Certificat non actif</p>
                    @else
                        <p class="text-sm text-green-600">✓ Certificat valide</p>
                    @endif
                </div>
            </div>

            <!-- API Key -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Clé API</h2>
                <div class="flex items-center gap-3 mb-4">
                    <code class="flex-1 bg-gray-200 px-4 py-3 rounded font-mono text-sm overflow-auto">{{ $store->api_key }}</code>
                    <button onclick="copyToClipboard('{{ $store->api_key }}')" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Copier
                    </button>
                </div>
                <form action="{{ route('stores.regenerateApiKey', $store) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr? L\'ancienne clé API ne fonctionnera plus.');">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">
                        Régénérer la clé API
                    </button>
                </form>
            </div>

            <!-- Timestamps -->
            <div class="text-sm text-gray-500 border-t pt-4">
                <p>Créé le {{ $store->created_at->format('d/m/Y à H:i') }}</p>
                <p>Mis à jour le {{ $store->updated_at->format('d/m/Y à H:i') }}</p>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4 border-t">
                <a href="{{ route('stores.edit', $store) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-center">
                    Éditer
                </a>
                

                <form action="{{ route('stores.destroy', $store) }}" method="POST" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Clé API copiée!');
    }).catch(() => {
        alert('Erreur lors de la copie');
    });
}
</script>

</x-layouts.app>
