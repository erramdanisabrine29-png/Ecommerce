<x-app-layout>
<div class="min-h-screen p-8 lg:p-16" style="background-color:#F8F5F0; font-family:'Inter', sans-serif;">

    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-semibold tracking-wide" style="color:#111111;">
            {{ __('Orders') }}
        </h1>

        @can('orders.create')
        <a href="{{ route('orders.create') }}"
           class="px-6 py-3 rounded-full text-sm font-medium transition-all duration-300"
           style="border:1px solid #111111; color:#111111;"
           onmouseover="this.style.backgroundColor='#111111'; this.style.color='#ffffff';"
           onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111111';">
            + {{ __('Create order') }}
        </a>
        @endcan
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-8 p-6 rounded-2xl"
             style="background-color:#E8DCCB; color:#111111;">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count())

        <div class="rounded-3xl overflow-hidden"
             style="background-color:white; box-shadow:0 15px 40px rgba(0,0,0,0.05);">

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">
                    <thead style="background-color:#E8DCCB;">
                        <tr class="text-left" style="color:#111111;">
                            <th class="px-6 py-4 font-medium">{{ __('Reference') }}</th>
                            <th class="px-6 py-4 font-medium">{{ __('Customer') }}</th>
                            <th class="px-6 py-4 font-medium">{{ __('Total') }}</th>
                            <th class="px-6 py-4 font-medium">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-right font-medium">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-b" style="border-color:#F1ECE6;">
                            <td class="px-6 py-4 font-semibold" style="color:#111111;">
                                {{ $order->reference }}
                            </td>
                            <td class="px-6 py-4" style="color:#555;">
                                #{{ $order->id_customer }}
                            </td>
                            <td class="px-6 py-4 font-semibold" style="color:#111111;">
                                €{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs"
                                      style="background-color:#F8F5F0; color:#111111;">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">

                                    <a href="{{ route('orders.show', $order) }}"
                                       class="text-sm transition"
                                       style="color:#111111;"
                                       onmouseover="this.style.opacity='0.6';"
                                       onmouseout="this.style.opacity='1';">
                                        {{ __('View') }}
                                    </a>

                                    @can('orders.update')
                                    <a href="{{ route('orders.edit', $order) }}"
                                       class="text-sm transition"
                                       style="color:#111111;"
                                       onmouseover="this.style.opacity='0.6';"
                                       onmouseout="this.style.opacity='1';">
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
                                                class="text-sm transition"
                                                style="color:#B91C1C;"
                                                onmouseover="this.style.opacity='0.6';"
                                                onmouseout="this.style.opacity='1';">
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

            <div class="px-6 py-4" style="background-color:#F8F5F0;">
                {{ $orders->links() }}
            </div>
        </div>

    @else

        <div class="text-center p-16 rounded-3xl"
             style="background-color:white; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
            <h2 class="text-2xl font-semibold mb-4" style="color:#111111;">
                {{ __('No orders') }}
            </h2>
            <p class="mb-6" style="color:#777;">
                {{ __('No orders found.') }}
            </p>

            @can('orders.create')
            <a href="{{ route('orders.create') }}"
               class="px-6 py-3 rounded-full text-sm font-medium transition-all duration-300"
               style="border:1px solid #111111; color:#111111;"
               onmouseover="this.style.backgroundColor='#111111'; this.style.color='#ffffff';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111111';">
                {{ __('Create order') }}
            </a>
            @endcan
        </div>

    @endif

</div>
</x-app-layout>