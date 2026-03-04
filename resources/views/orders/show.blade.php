<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('Order Details') }}
            </h1>
            <a href="{{ route('orders.index') }}" 
               class="px-5 py-2.5 rounded-lg text-sm font-semibold border transition-all duration-300"
               style="border-color:#E5E5E5; color:#666666;"
               onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                ← {{ __('Back to Orders') }}
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

        <!-- Order Info Card -->
        <div class="rounded-2xl overflow-hidden mb-6"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
            
            <div class="p-8">
                <div class="flex items-start justify-between">
                    <!-- Order Basic Info -->
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-xl flex items-center justify-center text-2xl font-bold"
                             style="background-color:#D4AF37; color:#0A0A0A;">
                            {{ strtoupper(substr($order->reference, 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color:#0A0A0A;">
                                {{ $order->reference }}
                            </h2>
                            <p class="text-sm mt-1" style="color:#666666;">
                                {{ __('Created') }}: {{ $order->created_at->format('d/m/Y H:i') }}
                            </p>
                            <div class="mt-3">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->order_status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->order_status == 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($order->order_status == 'processing') bg-purple-100 text-purple-800
                                    @elseif($order->order_status == 'shipped') bg-indigo-100 text-indigo-800
                                    @elseif($order->order_status == 'delivered') bg-green-100 text-green-800
                                    @elseif($order->order_status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        @can('orders.update')
                            <a href="{{ route('orders.edit', $order) }}"
                               class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                               style="border-color:#D4AF37; color:#D4AF37;"
                               onmouseover="this.style.backgroundColor='#D4AF37'; this.style.color='#0A0A0A';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D4AF37';">
                                {{ __('Edit') }}
                            </a>
                        @endcan
                        
                        @can('orders.delete')
                            <form method="POST" 
                                  action="{{ route('orders.destroy', $order) }}"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this order?') }}');">
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
                    <!-- Customer -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Customer') }}
                        </p>
                        @if($order->customer)
                            <p class="font-semibold" style="color:#0A0A0A;">
                                {{ $order->customer->first_name_customer }} {{ $order->customer->last_name_customer }}
                            </p>
                            <p class="text-sm" style="color:#666666;">
                                {{ $order->customer->email }}
                            </p>
                        @else
                            <p class="font-semibold" style="color:#0A0A0A;">
                                #{{ $order->id_customer }}
                            </p>
                        @endif
                    </div>

                    <!-- Channel -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Channel') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            {{ ucfirst($order->channel ?? 'Website') }}
                        </p>
                    </div>

                    <!-- Site -->
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Site/Store') }}
                        </p>
                        @if($order->site)
                            <p class="font-semibold" style="color:#0A0A0A;">
                                {{ $order->site->site_name }}
                            </p>
                        @else
                            <p class="font-semibold" style="color:#0A0A0A;">
                                #{{ $order->id_site }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Financial Details -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-0">
                    <!-- Total Amount -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Total Amount') }}
                        </p>
                        <p class="text-2xl font-bold" style="color:#D4AF37;">
                            €{{ number_format($order->total_amount, 2) }}
                        </p>
                    </div>

                    <!-- Shipping -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Shipping') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            €{{ number_format($order->shipping_amount ?? 0, 2) }}
                        </p>
                    </div>

                    <!-- Discount -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Discount') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            -€{{ number_format($order->discount ?? 0, 2) }}
                        </p>
                    </div>

                    <!-- Order ID -->
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Order ID') }}
                        </p>
                        <p class="font-mono text-sm" style="color:#0A0A0A;">
                            #{{ $order->id_order }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dates -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Created At') }}
                        </p>
                        <p class="font-semibold text-sm" style="color:#0A0A0A;">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Paid At') }}
                        </p>
                        <p class="font-semibold text-sm" style="color:#0A0A0A;">
                            {{ $order->paid_at ? $order->paid_at->format('d/m/Y H:i') : '-' }}
                        </p>
                    </div>
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Last Updated') }}
                        </p>
                        <p class="font-semibold text-sm" style="color:#0A0A0A;">
                            {{ $order->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($order->customer_notes || $order->internal_notes)
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    @if($order->customer_notes)
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-2" style="color:#666666;">
                            {{ __('Customer Notes') }}
                        </p>
                        <p class="text-sm" style="color:#0A0A0A;">
                            {{ $order->customer_notes }}
                        </p>
                    </div>
                    @endif
                    @if($order->internal_notes)
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-2" style="color:#666666;">
                            {{ __('Internal Notes') }}
                        </p>
                        <p class="text-sm" style="color:#0A0A0A;">
                            {{ $order->internal_notes }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
