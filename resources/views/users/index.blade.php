<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <flux:heading size="xl">{{ __('Users') }}</flux:heading>
            @can('users.create')
            <flux:button :href="route('users.create')" variant="primary" wire:navigate>{{ __('Create user') }}</flux:button>
            @endcan
        </div>

        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif

        <flux:card class="overflow-hidden p-0">
            <div class="overflow-x-auto">
                <flux:table class="p-4">
                    <flux:table.columns>
                        <flux:table.column>{{ __('Role') }}</flux:table.column>
                        <flux:table.column>{{ __('ID') }}</flux:table.column>
                        <flux:table.column>{{ __('Name') }}</flux:table.column>
                        <flux:table.column>{{ __('Email') }}</flux:table.column>
                        <flux:table.column class="text-end">{{ __('Actions') }}</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach($users as $user)
                        <flux:table.row>
                            <flux:table.cell>{{ implode(', ', $user->getRoleNames()->toArray()) }}</flux:table.cell>
                            <flux:table.cell>{{ $user->id }}</flux:table.cell>
                            <flux:table.cell>{{ $user->name }}</flux:table.cell>
                            <flux:table.cell>{{ $user->email }}</flux:table.cell>
                            <flux:table.cell class="text-end">
                                <div class="flex items-center justify-end gap-2">
                                    @can('users.update')
                                    <flux:button :href="route('users.edit', $user)" size="sm" variant="ghost" wire:navigate>{{ __('Edit') }}</flux:button>
                                    @endcan
                                    @can('users.delete')
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="danger">{{ __('Delete') }}</flux:button>
                                    </form>
                                    @endcan
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </div>
            <div class="border-t border-zinc-200 dark:border-white/10 px-6 py-3">
                {{ $users->links() }}
            </div>
        </flux:card>
    </div>
</x-app-layout>
