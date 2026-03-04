<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('Create Store') }}
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
                <form action="{{ route('stores.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Store Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Store Name') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}" 
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
                                   value="{{ old('url') }}" 
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
                                   value="{{ old('tax_rate', 20) }}" 
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
                                   value="{{ old('minimum_stock', 10) }}" 
                                   min="0"
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="10">
                        </div>
                    </div>

                    <!-- SSL Status Info -->
                    <div class="p-4 rounded-xl" style="background-color:#F8F8F8; border:1px solid #E5E5E5;">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" style="color:#666666;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm" style="color:#666666;">
                                {{ __('SSL certificate status will be automatically checked after store creation.') }}
                            </p>
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
                            {{ __('Create Store') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
