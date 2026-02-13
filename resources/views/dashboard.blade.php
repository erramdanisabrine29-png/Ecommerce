<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                @role('Merchant')
                    <div class="p-6 border-t dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Quick actions') }}</p>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Manage your store') }}</p>
                        </div>
                        @php $pending = \App\Models\Order::countForMerchant(auth()->id() ?? null); @endphp
                        <div class="flex items-center gap-3">
                            <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md text-sm hover:shadow" role="button" aria-label="{{ $pending }} pending orders">
                                <svg class="w-4 h-4 text-zinc-600 dark:text-zinc-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9"/></svg>
                                <span>{{ __('My orders') }}</span>
                                @if($pending > 0)
                                    <span class="inline-flex items-center justify-center rounded-full bg-red-600 text-white text-xs font-semibold w-5 h-5">{{ $pending }}</span>
                                @endif
                            </a>

                            <a href="{{ route('stores.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md text-sm hover:shadow">
                                <svg class="w-4 h-4 text-zinc-600 dark:text-zinc-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7"/></svg>
                                <span>{{ __('My stores') }}</span>
                            </a>

                            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md text-sm hover:shadow">
                                <svg class="w-4 h-4 text-zinc-600 dark:text-zinc-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>{{ __('My users') }}</span>
                            </a>
                        </div>
                    </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
