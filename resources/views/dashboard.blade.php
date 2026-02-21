<x-app-layout>
    <div class="min-h-screen p-8 lg:p-16" style="background-color:#F8F5F0; font-family:'Inter', sans-serif;">

        <!-- Title -->
        <h1 class="text-4xl font-semibold mb-10 tracking-wide" style="color:#111111;">
            {{ __('Dashboard') }}
        </h1>

        <!-- Logged In Card -->
        <div class="mb-8 p-8 rounded-3xl shadow-sm"
             style="background-color:#E8DCCB; box-shadow:0 10px 30px rgba(0,0,0,0.04);">
            <p class="text-lg" style="color:#111111;">
                {{ __("You're logged in!") }}
            </p>
        </div>

        @if(auth()->user()->hasRole('Merchant') || auth()->user()->hasRole('Administrator'))

        <!-- Quick Actions Card -->
        <div class="p-10 rounded-3xl transition-all duration-300 mb-10"
             style="background-color:white; box-shadow:0 15px 40px rgba(0,0,0,0.05);">

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">

                <!-- Left Side -->
                <div>
                    <p class="uppercase tracking-widest text-sm mb-2"
                       style="color:#777;">
                        {{ __('Quick actions') }}
                    </p>
                    <h2 class="text-2xl font-semibold"
                        style="color:#111111;">
                        {{ __('Manage your store') }}
                    </h2>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap items-center gap-4">

                    @can('stores.read')
                    <a href="{{ route('stores.index') }}" wire:navigate
                       class="px-6 py-3 rounded-full text-sm font-medium transition-all duration-300"
                       style="border:1px solid #111111; color:#111111;"
                       onmouseover="this.style.backgroundColor='#111111'; this.style.color='#ffffff';"
                       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111111';">
                        {{ __('My stores') }}
                    </a>
                    @endcan

                    @can('users.read')
                    <a href="{{ route('users.index') }}" wire:navigate
                       class="px-6 py-3 rounded-full text-sm font-medium transition-all duration-300"
                       style="border:1px solid #111111; color:#111111;"
                       onmouseover="this.style.backgroundColor='#111111'; this.style.color='#ffffff';"
                       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111111';">
                        {{ __('Users') }}
                    </a>
                    @endcan

                </div>

            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Total Orders -->
            <div class="p-8 rounded-3xl shadow-lg"
                 style="background-color:#FFFDF7; border:1px solid #D8CFC4;">
                <p class="text-sm uppercase tracking-widest text-gray-700 mb-2">Total Orders</p>
                <h3 class="text-3xl font-bold text-gray-900">1,245</h3>
                <p class="text-sm text-gray-600 mt-1">All-time orders placed</p>
            </div>

            <!-- Orders Delivered -->
            <div class="p-8 rounded-3xl shadow-lg"
                 style="background-color:#FFFDF7; border:1px solid #D8CFC4;">
                <p class="text-sm uppercase tracking-widest text-gray-700 mb-2">Orders Delivered</p>
                <h3 class="text-3xl font-bold text-gray-900">1,020</h3>
                <p class="text-sm text-gray-600 mt-1">Successful deliveries</p>
            </div>

            <!-- Orders Cancelled -->
            <div class="p-8 rounded-3xl shadow-lg"
                 style="background-color:#FFFDF7; border:1px solid #D8CFC4;">
                <p class="text-sm uppercase tracking-widest text-gray-700 mb-2">Orders Cancelled</p>
                <h3 class="text-3xl font-bold text-gray-900">85</h3>
                <p class="text-sm text-gray-600 mt-1">Cancelled or refused orders</p>
            </div>

        </div>

        @endif

    </div>
</x-app-layout>