<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('Edit Store') }}
            </h1>
            <a href="{{ route('stores.index') }}" 
               class="px-5 py-2.5 rounded-lg text-sm font-semibold border transition-all duration-300"
               style="border-color:#E5E5E5; color:#666666;"
               onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                ← {{ __('Back') }}
            </a>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-8 p-6 rounded-xl"
                 style="background-color:#FFFFFF; border:1px solid #EF4444; box-shadow:0 10px 30px rgba(239,68,68,0.1);">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5" style="color:#EF4444;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold" style="color:#EF4444;">{{ __('Please fix the following errors:') }}</span>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1" style="color:#666666;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="rounded-2xl overflow-hidden"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
            
            <div class="p-8">
                <form action="{{ route('stores.update', $store) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Store Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Store Name') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $store->name) }}" 
                                   required
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="{{ __('Enter store name') }}">
                        </div>

                        <!-- Store URL -->
                        <div>
                            <label for="url" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Store URL') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <input type="url" 
                                   name="url" 
                                   id="url" 
                                   value="{{ old('url', $store->url) }}" 
                                   required
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="https://example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tax Rate -->
                        <div>
                            <label for="tax_rate" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Tax Rate (%)') }}
                            </label>
                            <input type="number" 
                                   name="tax_rate" 
                                   id="tax_rate" 
                                   value="{{ old('tax_rate', $store->tax_rate) }}" 
                                   step="0.01"
                                   min="0"
                                   max="100"
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="20.00">
                        </div>

                        <!-- Minimum Stock -->
                        <div>
                            <label for="minimum_stock" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Minimum Stock Alert') }}
                            </label>
                            <input type="number" 
                                   name="minimum_stock" 
                                   id="minimum_stock" 
                                   value="{{ old('minimum_stock', $store->minimum_stock) }}" 
                                   min="0"
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="10">
                        </div>
                    </div>

                    <!-- API Key Section -->
                    <div class="border-t pt-6" style="border-color:#E5E5E5;">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold" style="color:#0A0A0A;">
                                    {{ __('API Key') }}
                                </h3>
                                <p class="text-sm" style="color:#666666;">
                                    {{ __('Use this key to authenticate API requests.') }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('stores.regenerateApiKey', $store) }}">
                                @csrf
                                <button type="submit" 
                                        class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                        style="border-color:#D4AF37; color:#D4AF37;"
                                        onmouseover="this.style.backgroundColor='#D4AF37'; this.style.color='#0A0A0A';"
                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D4AF37';"
                                        onclick="return confirm('{{ __('Are you sure you want to regenerate the API key?') }}');">
                                    {{ __('Regenerate') }}
                                </button>
                            </form>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="text" 
                                   value="{{ $store->api_key }}" 
                                   readonly
                                   class="flex-1 px-4 py-3 rounded-xl border font-mono text-sm"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;">
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

                    <!-- SSL Status -->
                    <div class="border-t pt-6" style="border-color:#E5E5E5;">
                        <h3 class="text-lg font-semibold mb-4" style="color:#0A0A0A;">
                            {{ __('SSL Certificate') }}
                        </h3>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                  style="background-color: {{ $store->ssl_certificate_status === 'active' ? '#D4EDDA' : '#F8D7DA' }};
                                         color: {{ $store->ssl_certificate_status === 'active' ? '#155724' : '#721C24' }};">
                                {{ ucfirst($store->ssl_certificate_status) }}
                            </span>
                            <span class="text-sm" style="color:#666666;">
                                @if($store->ssl_certificate_status === 'active')
                                    {{ __('SSL certificate is active and valid.') }}
                                @else
                                    {{ __('SSL certificate is not active.') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('stores.index') }}" 
                           class="px-6 py-3 rounded-xl text-sm font-semibold border transition-all duration-300"
                           style="border-color:#E5E5E5; color:#666666;"
                           onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300"
                                style="background-color:#D4AF37; color:#0A0A0A;"
                                onmouseover="this.style.backgroundColor='#B8962E';"
                                onmouseout="this.style.backgroundColor='#D4AF37';">
                            {{ __('Update Store') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('{{ __("API key copied to clipboard!") }}');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
</x-app-layout>
