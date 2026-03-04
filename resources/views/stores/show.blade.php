<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('Store Details') }}
            </h1>
            <a href="{{ route('stores.index') }}" 
               class="px-5 py-2.5 rounded-lg text-sm font-semibold border transition-all duration-300"
               style="border-color:#E5E5E5; color:#666666;"
               onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                ← {{ __('Back to Stores') }}
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-xl"
                 style="background-color:#FFFFFF; border:1px solid #D4AF37; color:#0A0A0A;">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" style="color:#D4AF37;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Store Info Card -->
        <div class="rounded-2xl overflow-hidden mb-6"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
            
            <div class="p-8">
                <div class="flex items-start justify-between">
                    <!-- Store Basic Info -->
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-xl flex items-center justify-center text-2xl font-bold"
                             style="background-color:#D4AF37; color:#0A0A0A;">
                            {{ strtoupper(substr($store->name, 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color:#0A0A0A;">
                                {{ $store->name }}
                            </h2>
                            <p class="text-sm mt-1" style="color:#666666;">
                                {{ $store->url }}
                            </p>
                            <div class="mt-3 flex items-center gap-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                      style="background-color: {{ $store->ssl_certificate_status === 'active' ? '#D4EDDA' : '#F8D7DA' }};
                                             color: {{ $store->ssl_certificate_status === 'active' ? '#155724' : '#721C24' }};">
                                    {{ ucfirst($store->ssl_certificate_status) }}
                                </span>
                                @if($store->shopify_connected_at)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                          style="background-color:#D4EDDA; color:#155724;">
                                        Shopify Connected
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        @can('stores.update')
                            <button type="button"
                                    onclick="generateWebhookSecret({{ $store->id }})"
                                    id="applicationBtn"
                                    class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                    style="border-color:#3B82F6; color:#3B82F6;"
                                    onmouseover="this.style.backgroundColor='#3B82F6'; this.style.color='#FFFFFF';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#3B82F6';">
                                {{ __('Application') }}
                            </button>
                            
                            <a href="{{ route('stores.edit', $store) }}"
                               class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                               style="border-color:#D4AF37; color:#D4AF37;"
                               onmouseover="this.style.backgroundColor='#D4AF37'; this.style.color='#0A0A0A';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D4AF37';">
                                {{ __('Edit') }}
                            </a>
                        @endcan
                        
                        @can('stores.delete')
                            <form method="POST" 
                                  action="{{ route('stores.destroy', $store) }}"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this store?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                        style="border-color:#EF4444; color:#EF4444;"
                                        onmouseover="this.style.backgroundColor='#EF4444'; this.style.color='#FFFFFF';"
                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#EF4444';">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                    <!-- Store URL -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Store URL') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            <a href="{{ $store->url }}" target="_blank" class="hover:underline" style="color:#D4AF37;">
                                {{ $store->url }}
                            </a>
                        </p>
                    </div>

                    <!-- Tax Rate -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Tax Rate') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            {{ $store->tax_rate }}%
                        </p>
                    </div>

                    <!-- Minimum Stock -->
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Minimum Stock Alert') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            {{ $store->minimum_stock }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- API Key Section -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="p-6">
                    <p class="text-xs uppercase tracking-wider mb-2" style="color:#666666;">
                        {{ __('API Key') }}
                    </p>
                    <div class="flex items-center gap-2">
                        <input type="password" 
                               value="{{ $store->api_key }}" 
                               id="apiKey"
                               readonly
                               class="flex-1 px-4 py-3 rounded-xl border font-mono text-sm"
                               style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;">
                        <button type="button" 
                                onclick="toggleApiKey()"
                                class="px-4 py-2 text-sm font-semibold rounded-lg border transition-all duration-300"
                                style="border-color:#E5E5E5; color:#666666;"
                                onmouseover="this.style.backgroundColor='#F8F8F8';"
                                onmouseout="this.style.backgroundColor='transparent';">
                            {{ __('Show') }}
                        </button>
                        <button type="button" 
                                onclick="copyToClipboard('{{ $store->api_key }}')"
                                class="px-4 py-2 text-sm font-semibold rounded-lg border transition-all duration-300"
                                style="border-color:#E5E5E5; color:#666666;"
                                onmouseover="this.style.backgroundColor='#F8F8F8';"
                                onmouseout="this.style.backgroundColor='transparent';">
                            {{ __('Copy') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Store ID') }}
                        </p>
                        <p class="font-mono text-sm" style="color:#0A0A0A;">
                            #{{ $store->id }}
                        </p>
                    </div>
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Created At') }}
                        </p>
                        <p class="font-semibold text-sm" style="color:#0A0A0A;">
                            {{ $store->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Last Updated') }}
                        </p>
                        <p class="font-semibold text-sm" style="color:#0A0A0A;">
                            {{ $store->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleApiKey() {
            const input = document.getElementById('apiKey');
            const button = input.nextElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = '{{ __("Hide") }}';
            } else {
                input.type = 'password';
                button.textContent = '{{ __("Show") }}';
            }
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('{{ __("API key copied to clipboard!") }}');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }

        function generateWebhookSecret(storeId) {
            const button = document.getElementById('applicationBtn');
            const originalText = button.textContent;
            
            // Show loading state
            button.disabled = true;
            button.textContent = '{{ __("Generating...") }}';
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/stores/${storeId}/applications/shopify/generate-secret`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message with the generated webhook secret
                    const webhookSecret = data.webhook_secret;
                    alert('Webhook secret generated successfully!\n\nSecret: ' + webhookSecret + '\n\nPlease save this secret securely.');
                    button.textContent = '{{ __("Generated") }}';
                    button.style.borderColor = '#10B981';
                    button.style.color = '#10B981';
                } else {
                    alert('Error: ' + data.message);
                    button.textContent = originalText;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while generating the webhook secret.');
                button.textContent = originalText;
                button.disabled = false;
            });
        }
    </script>
</x-app-layout>
