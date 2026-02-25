<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-bold" style="color:#0A0A0A;">
                {{ __('Dashboard') }}
            </h1>
        </div>

        <!-- Logged In Card -->
        <div class="mb-10 p-8 rounded-2xl" 
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 10px 30px rgba(0,0,0,0.04);">
            <p class="text-lg font-medium" style="color:#0A0A0A;">
                {{ __("You're logged in!") }}
            </p>
        </div>

        @if(auth()->user()->hasRole('Merchant') || auth()->user()->hasRole('Administrator'))

        <!-- Quick Actions Card -->
        <div class="p-8 rounded-2xl transition-all duration-300 mb-10"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">

                <!-- Left Side -->
                <div>
                    <p class="uppercase tracking-widest text-sm mb-2"
                       style="color:#666666;">
                        {{ __('Quick actions') }}
                    </p>
                    <h2 class="text-2xl font-bold"
                        style="color:#0A0A0A;">
                        {{ __('Manage your store') }}
                    </h2>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap items-center gap-4">

                    @can('stores.read')
                    <a href="{{ route('stores.index') }}" wire:navigate
                       class="px-6 py-3 rounded-lg text-sm font-semibold transition-all duration-300"
                       style="background-color:#D4AF37; color:#0A0A0A;"
                       onmouseover="this.style.backgroundColor='#B8962E';"
                       onmouseout="this.style.backgroundColor='#D4AF37';">
                        {{ __('My stores') }}
                    </a>
                    @endcan

                    @can('users.read')
                    <a href="{{ route('users.index') }}" wire:navigate
                       class="px-6 py-3 rounded-lg text-sm font-semibold transition-all duration-300"
                       style="border:2px solid #0A0A0A; color:#0A0A0A;"
                       onmouseover="this.style.backgroundColor='#0A0A0A'; this.style.color='#FFFFFF';"
                       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#0A0A0A';">
                        {{ __('Users') }}
                    </a>
                    @endcan

                </div>

            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Total Orders -->
            <div class="p-8 rounded-2xl"
                 style="background-color:#FFFFFF; border:1px solid #E5E5E5;">
                <p class="text-sm uppercase tracking-widest mb-2" style="color:#666666;">Total Orders</p>
                <h3 class="text-4xl font-bold" style="color:#0A0A0A;">1,245</h3>
                <p class="text-sm mt-2" style="color:#666666;">All-time orders placed</p>
            </div>

            <!-- Orders Delivered -->
            <div class="p-8 rounded-2xl"
                 style="background-color:#FFFFFF; border:1px solid #E5E5E5;">
                <p class="text-sm uppercase tracking-widest mb-2" style="color:#666666;">Orders Delivered</p>
                <h3 class="text-4xl font-bold" style="color:#0A0A0A;">1,020</h3>
                <p class="text-sm mt-2" style="color:#666666;">Successful deliveries</p>
            </div>

            <!-- Orders Cancelled -->
            <div class="p-8 rounded-2xl"
                 style="background-color:#FFFFFF; border:1px solid #E5E5E5;">
                <p class="text-sm uppercase tracking-widest mb-2" style="color:#666666;">Orders Cancelled</p>
                <h3 class="text-4xl font-bold" style="color:#0A0A0A;">85</h3>
                <p class="text-sm mt-2" style="color:#666666;">Cancelled or refused orders</p>
            </div>

        </div>

        @endif

    </div>
</x-app-layout>
