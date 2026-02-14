<x-app-layout>
    <div class="p-6 lg:p-8">
        <flux:heading size="xl" class="mb-6">{{ __('Edit user') }}</flux:heading>

        <flux:card class="max-w-2xl">
            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <flux:card class="!border-red-500 !bg-red-50 dark:!bg-red-950/30">
                        <ul class="list-disc list-inside text-red-700 dark:text-red-400 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </flux:card>
                @endif

                <flux:input name="name" type="text" :label="__('Name')" :value="old('name', $user->name)" required />
                <flux:input name="email" type="email" :label="__('Email')" :value="old('email', $user->email)" required />

                <flux:select name="role" :label="__('Role')" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @selected($user->hasRole($role->name))>{{ $role->name }}</option>
                        @endforeach
                </flux:select>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">{{ __('Update') }}</flux:button>
                    <flux:button :href="route('users.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-app-layout>
