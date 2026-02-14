<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Profile') }}</flux:heading>

        <div class="max-w-2xl space-y-6">
            <flux:card>
                <flux:heading size="lg" class="mb-4">{{ __('Profile information') }}</flux:heading>
                @include('profile.partials.update-profile-information-form')
            </flux:card>

            <flux:card>
                <flux:heading size="lg" class="mb-4">{{ __('Update password') }}</flux:heading>
                @include('profile.partials.update-password-form')
            </flux:card>

            <flux:card>
                <flux:heading size="lg" class="mb-4">{{ __('Delete account') }}</flux:heading>
                @include('profile.partials.delete-user-form')
            </flux:card>
        </div>
    </div>
</x-app-layout>
