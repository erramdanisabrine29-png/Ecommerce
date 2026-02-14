<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <flux:heading size="xl">{{ __('Orders') }}</flux:heading>
            @can('orders.create')
            <flux:button :href="route('orders.create')" variant="primary" wire:navigate>+ {{ __('Create order') }}</flux:button>
            @endcan
        </div>

        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif

        @if($orders->count())
            <flux:card class="overflow-hidden p-0">
                <div class="overflow-x-auto">
                    <flux:table>
                        <flux:table.columns>
                            <flux:table.column>{{ __('Reference') }}</flux:table.column>
                            <flux:table.column>{{ __('Customer') }}</flux:table.column>
                            <flux:table.column>{{ __('Total') }}</flux:table.column>
                            <flux:table.column>{{ __('Status') }}</flux:table.column>
                            <flux:table.column align="end">{{ __('Actions') }}</flux:table.column>
                        </flux:table.columns>
                        <flux:table.rows>
                            @foreach($orders as $order)
                            <flux:table.row>
                                <flux:table.cell variant="strong">{{ $order->reference }}</flux:table.cell>
                                <flux:table.cell>#{{ $order->id_customer }}</flux:table.cell>
                                <flux:table.cell variant="strong">€{{ number_format($order->total_amount, 2) }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge color="zinc" size="sm">{{ ucfirst($order->order_status) }}</flux:badge>
                                </flux:table.cell>
                                <flux:table.cell align="end">
                                    <div class="flex items-center justify-end gap-2">
                                        <flux:button :href="route('orders.show', $order)" size="sm" variant="ghost" wire:navigate>{{ __('View') }}</flux:button>
                                        @can('orders.update')
                                        <flux:button :href="route('orders.edit', $order)" size="sm" variant="ghost" wire:navigate>{{ __('Edit') }}</flux:button>
                                        @endcan
                                        @can('orders.delete')
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Delete order?') }}');">
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
                    {{ $orders->links() }}
                </div>
            </flux:card>
        @else
            <flux:card class="text-center py-12">
                <flux:heading size="lg" class="mb-4">{{ __('No orders') }}</flux:heading>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6">{{ __('No orders found.') }}</p>
                @can('orders.create')
                <flux:button :href="route('orders.create')" variant="primary" wire:navigate>{{ __('Create order') }}</flux:button>
                @endcan
            </flux:card>
        @endif
    </div>
</x-app-layout>
