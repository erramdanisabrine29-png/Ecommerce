<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('Create Order') }}
            </h1>
            <a href="{{ route('orders.index') }}" 
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
                <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Reference -->
                        <div>
                            <label for="reference" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Order Reference') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <input type="text" 
                                   name="reference" 
                                   id="reference" 
                                   value="{{ old('reference', 'ORD-' . strtoupper(uniqid())) }}" 
                                   required
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="ORD-XXXXXX">
                        </div>

                        <!-- Channel -->
                        <div>
                            <label for="channel" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Channel') }}
                            </label>
                            <select name="channel" 
                                    id="channel"
                                    class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                    style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                    onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                    onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';">
                                <option value="website" {{ old('channel') == 'website' ? 'selected' : '' }}>Website</option>
                                <option value="phone" {{ old('channel') == 'phone' ? 'selected' : '' }}>Phone</option>
                                <option value="email" {{ old('channel') == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="pos" {{ old('channel') == 'pos' ? 'selected' : '' }}>POS</option>
                                <option value="marketplace" {{ old('channel') == 'marketplace' ? 'selected' : '' }}>Marketplace</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer -->
                        <div>
                            <label for="id_customer" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Customer') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <select name="id_customer" 
                                    id="id_customer" 
                                    required
                                    class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                    style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                    onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                    onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';">
                                <option value="" disabled selected>{{ __('Select a customer') }}</option>
                                @isset($customers)
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id_customer }}" {{ old('id_customer') == $customer->id_customer ? 'selected' : '' }}>
                                            {{ $customer->first_name_customer }} {{ $customer->last_name_customer }} ({{ $customer->email }})
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <!-- Site/Store -->
                        <div>
                            <label for="id_site" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Site/Store') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <select name="id_site" 
                                    id="id_site" 
                                    required
                                    class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                    style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                    onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                    onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';">
                                <option value="" disabled selected>{{ __('Select a site') }}</option>
                                @isset($sites)
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id_site }}" {{ old('id_site') == $site->id_site ? 'selected' : '' }}>
                                            {{ $site->site_name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Total Amount -->
                        <div>
                            <label for="total_amount" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Total Amount') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2" style="color:#666666;">€</span>
                                <input type="number" 
                                       name="total_amount" 
                                       id="total_amount" 
                                       value="{{ old('total_amount', 0) }}" 
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full pl-8 pr-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                       style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                       onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Shipping Amount -->
                        <div>
                            <label for="shipping_amount" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Shipping Amount') }}
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2" style="color:#666666;">€</span>
                                <input type="number" 
                                       name="shipping_amount" 
                                       id="shipping_amount" 
                                       value="{{ old('shipping_amount', 0) }}" 
                                       step="0.01"
                                       min="0"
                                       class="w-full pl-8 pr-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                       style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                       onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Discount -->
                        <div>
                            <label for="discount" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Discount') }}
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2" style="color:#666666;">€</span>
                                <input type="number" 
                                       name="discount" 
                                       id="discount" 
                                       value="{{ old('discount', 0) }}" 
                                       step="0.01"
                                       min="0"
                                       class="w-full pl-8 pr-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                       style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                       onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                       placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <!-- Order Status -->
                    <div>
                        <label for="order_status" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                            {{ __('Order Status') }}
                        </label>
                        <select name="order_status" 
                                id="order_status"
                                class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';">
                            <option value="pending" {{ old('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('order_status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ old('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ old('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ old('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="customer_notes" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                            {{ __('Customer Notes') }}
                        </label>
                        <textarea name="customer_notes" 
                                  id="customer_notes" 
                                  rows="3"
                                  class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                  style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                  onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                  onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                  placeholder="{{ __('Optional notes from the customer') }}">{{ old('customer_notes') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('orders.index') }}" 
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
                            {{ __('Create Order') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
