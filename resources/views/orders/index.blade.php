<x-app-layout>

    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">

        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-bold" style="color:#0A0A0A;">
                {{ __('Orders') }}
            </h1>

            @can('orders.create')
                <a href="{{ route('orders.create') }}"
                   class="px-6 py-3 rounded-lg text-sm font-semibold transition-all duration-300"
                   style="background-color:#D4AF37; color:#0A0A0A;"
                   onmouseover="this.style.backgroundColor='#B8962E';"
                   onmouseout="this.style.backgroundColor='#D4AF37';">
                    + {{ __('Create order') }}
                </a>
            @endcan
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-xl"
                 style="background-color:#FFFFFF; border:1px solid #D4AF37; color:#0A0A0A;">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->count())

            <!-- Card -->
            <div class="rounded-xl overflow-hidden"
                 style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <!-- Table Head -->
                        <thead style="background-color:#F8F8F8;">
                            <tr class="text-left uppercase tracking-wider text-xs">
                                <th class="px-6 py-4 font-semibold" style="color:#666666;">{{ __('Reference') }}</th>
                                <th class="px-6 py-4 font-semibold" style="color:#666666;">{{ __('Customer') }}</th>
                                <th class="px-6 py-4 font-semibold" style="color:#666666;">{{ __('Total') }}</th>
                                <th class="px-6 py-4 font-semibold" style="color:#666666;">{{ __('Status') }}</th>
                                <th class="px-6 py-4 text-right font-semibold" style="color:#666666;">{{ __('Actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            <tr class="border-b transition-all duration-300 hover:bg-gray-50" style="border-color:#E5E5E5;">
                                <td class="px-6 py-4 font-semibold" style="color:#333333;">
                                    {{ $order->reference }}
                                </td>
                                <td class="px-6 py-4" style="color:#666666;">
                                    #{{ $order->id_customer }}
                                </td>
                                <td class="px-6 py-4 font-semibold" style="color:#333333;">
                                    €{{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'confirmed') bg-blue-100 text-blue-800
                                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('orders.show', $order) }}"
                                           class="text-sm font-medium transition-colors"
                                           style="color:#D4AF37;"
                                           onmouseover="this.style.color='#B8962E';"
                                           onmouseout="this.style.color='#D4AF37';">
                                            {{ __('View') }}
                                        </a>

                                        @can('orders.update')
                                        <a href="{{ route('orders.edit', $order) }}"
                                           class="text-sm font-medium transition-colors"
                                           style="color:#666666;"
                                           onmouseover="this.style.color='#0A0A0A';"
                                           onmouseout="this.style.color='#666666';">
                                            {{ __('Edit') }}
                                        </a>
                                        @endcan

                                        @can('orders.delete')
                                        <form action="{{ route('orders.destroy', $order) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('{{ __('Delete order?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-sm font-medium transition-colors"
                                                    style="color:#DC2626;"
                                                    onmouseover="this.style.color='#B91C1C';"
                                                    onmouseout="this.style.color='#DC2626';">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t" style="background-color:#FFFFFF; border-color:#E5E5E5;">
                    {{ $orders->links() }}
                </div>
            </div>

        @else

            <!-- Empty State -->
            <div class="text-center p-16 rounded-xl"
                 style="background-color:#FFFFFF; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
                <h2 class="text-2xl font-bold mb-4" style="color:#0A0A0A;">
                    {{ __('No Orders') }}
                </h2>
                <p class="mb-6" style="color:#666666;">
                    {{ __('No orders found.') }}
                </p>

                @can('orders.create')
                <a href="{{ route('orders.create') }}"
                   class="px-6 py-3 rounded-lg text-sm font-semibold transition-all duration-300"
                   style="background-color:#D4AF37; color:#0A0A0A;"
                   onmouseover="this.style.backgroundColor='#B8962E';"
                   onmouseout="this.style.backgroundColor='#D4AF37';">
                    {{ __('Create order') }}
                </a>
                @endcan
            </div>

        @endif

    </div>

</x-app-layout>
