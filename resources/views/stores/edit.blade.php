<x-layouts.app>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Éditer : {{ $store->name }}</h1>

        <form action="{{ route('stores.update', $store) }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du magasin *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $store->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL -->
            <div class="mb-6">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL du site *</label>
                <input type="url" id="url" name="url" value="{{ old('url', $store->url) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('url') border-red-500 @enderror" required>
                @error('url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SSL Certificate Status -->
            <div class="mb-6">
                <label for="ssl_certificate_status" class="block text-sm font-medium text-gray-700 mb-2">Statut du certificat SSL *</label>
                <select id="ssl_certificate_status" name="ssl_certificate_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ssl_certificate_status') border-red-500 @enderror" required>
                    <option value="active" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'active')>Actif</option>
                    <option value="inactive" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'inactive')>Inactif</option>
                    <option value="expired" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'expired')>Expiré</option>
                    <option value="pending" @selected(old('ssl_certificate_status', $store->ssl_certificate_status) === 'pending')>En attente</option>
                </select>
                @error('ssl_certificate_status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tax Rate -->
            <div class="mb-6">
                <label for="tax_rate" class="block text-sm font-medium text-gray-700 mb-2">Taux de TVA (%) *</label>
                <input type="number" id="tax_rate" name="tax_rate" value="{{ old('tax_rate', $store->tax_rate) }}" step="0.01" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tax_rate') border-red-500 @enderror" required>
                @error('tax_rate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Minimum Stock -->
            <div class="mb-6">
                <label for="minimum_stock" class="block text-sm font-medium text-gray-700 mb-2">Stock minimum *</label>
                <input type="number" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', $store->minimum_stock) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('minimum_stock') border-red-500 @enderror" required>
                @error('minimum_stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info about API Key -->
            <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-sm text-blue-800">
                    <strong>Clé API actuelle :</strong> <code class="bg-blue-100 px-2 py-1 rounded">{{ $store->api_key }}</code>
                </p>
                <p class="text-sm text-blue-700 mt-2">Pour régénérer la clé API, allez sur la page de détails du magasin.</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Mettre à jour
                </button>
                <a href="{{ route('stores.show', $store) }}" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-center">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

</x-layouts.app>
