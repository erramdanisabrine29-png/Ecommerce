<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Create user') }}</flux:heading>

        <flux:card class="max-w-2xl">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                @if($errors->any())
                    <flux:card class="!border-red-500 !bg-red-50 dark:!bg-red-950/30">
                        <ul class="list-disc list-inside text-red-700 dark:text-red-400 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </flux:card>
                @endif

                <flux:input name="name" type="text" :label="__('Name')" :value="old('name')" required />
                <flux:input name="email" type="email" :label="__('Email')" :value="old('email')" required />
                <flux:input name="password" type="password" :label="__('Password')" required />
                <flux:input name="password_confirmation" type="password" :label="__('Confirm password')" required />

                <flux:select name="role" :label="__('Role')" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                </flux:select>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Create') }}</flux:button>
                    <flux:button :href="route('users.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-app-layout>
