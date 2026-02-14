<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Dashboard') }}</flux:heading>

        <flux:card class="mb-6">
            <p class="text-zinc-600 dark:text-zinc-400">{{ __("You're logged in!") }}</p>
        </flux:card>

        @if(auth()->user()->hasRole('Merchant') || auth()->user()->hasRole('Administrator'))
        <flux:card class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <flux:heading size="sm" class="text-zinc-500 dark:text-zinc-400">{{ __('Quick actions') }}</flux:heading>
                    <flux:heading size="lg" class="mt-1">{{ __('Manage your store') }}</flux:heading>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    @can('stores.read')
                    <a href="{{ route('stores.index') }}" wire:navigate>
                        <flux:button icon="building-storefront" variant="outline">{{ __('My stores') }}</flux:button>
                    </a>
                    @endcan
                    @can('users.read')
                    <a href="{{ route('users.index') }}" wire:navigate>
                        <flux:button icon="users" variant="outline">{{ __('Users') }}</flux:button>
                    </a>
                    @endcan
                </div>
        </flux:card>
        @endif
    </div>
</x-app-layout>
