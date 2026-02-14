<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <flux:heading size="xl">{{ isset($store) ? __('Products') . ' — ' . $store->name : __('Products') }}</flux:heading>
                <p class="text-zinc-600 dark:text-zinc-400 mt-1 text-sm">{{ isset($store) ? __('Products for this store') : __('Manage your products and inventory') }}</p>
            </div>
            @can('products.create')
            <flux:button :href="route('products.create')" variant="primary" wire:navigate>+ {{ __('Add product') }}</flux:button>
            @endcan
        </div>

        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif
        @if(session('error'))
            <flux:card class="mb-6 !border-red-500 !bg-red-50 dark:!bg-red-950/30">
                <p class="text-red-700 dark:text-red-400 text-sm">{{ session('error') }}</p>
            </flux:card>
        @endif

        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <flux:card class="flex flex-col">
                        <flux:heading size="lg" class="mb-2">{{ $product->product_name }}</flux:heading>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Price ex. tax') }}</span>
                                <span class="font-semibold text-zinc-800 dark:text-zinc-200">€{{ number_format($product->price_excl_tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Price inc. tax') }}</span>
                                <span class="font-semibold text-zinc-800 dark:text-zinc-200">€{{ number_format($product->price_incl_tax, 2) }}</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-zinc-100 dark:bg-white/10 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Stock') }}</span>
                                <span class="font-semibold">{{ $product->available_stock }}</span>
                            </div>
                            <div class="flex justify-between text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                <span>{{ __('Safety stock') }}</span>
                                <span>{{ $product->safety_stock }}</span>
                            </div>
                            @if($product->isLowStock())
                                <flux:badge color="red" size="sm" class="mt-2">{{ __('Low stock') }}</flux:badge>
                            @endif
                        </div>
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">{{ __('Ref') }}: <code class="bg-zinc-200 dark:bg-white/10 px-1.5 py-0.5 rounded">{{ $product->reference }}</code></p>
                        <div class="flex gap-2 mt-auto">
                            <flux:button :href="route('products.show', $product)" size="sm" variant="primary" wire:navigate>{{ __('View') }}</flux:button>
                            @can('products.update')
                            <flux:button :href="route('products.edit', $product)" size="sm" variant="outline" wire:navigate>{{ __('Edit') }}</flux:button>
                            @endcan
                            @can('products.delete')
                            <form method="POST" action="{{ route('products.destroy', $product) }}" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                @csrf
                                @method('DELETE')
                                <flux:button type="submit" size="sm" variant="danger">{{ __('Delete') }}</flux:button>
                            </form>
                            @endcan
                        </div>
                    </flux:card>
                @endforeach
            </div>
            <div class="mt-6">{{ $products->links() }}</div>
        @else
            <flux:card class="text-center py-12">
                <flux:heading size="lg" class="mb-4">{{ __('No products') }}</flux:heading>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6">{{ __('Create your first product to get started.') }}</p>
                @can('products.create')
                <flux:button :href="route('products.create')" variant="primary" wire:navigate>{{ __('Add product') }}</flux:button>
                @endcan
            </flux:card>
        @endif
    </div>
</x-app-layout>
