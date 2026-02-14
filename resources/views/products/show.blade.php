<x-app-layout>
    <div class="p-6 lg:p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <flux:heading size="xl">{{ $product->product_name }}</flux:heading>
                <p class="text-zinc-600 dark:text-zinc-400 mt-1 text-sm">{{ __('Reference') }}: <code class="bg-zinc-200 dark:bg-white/10 px-2 py-1 rounded text-sm">{{ $product->reference }}</code></p>
            </div>
            <div class="flex gap-2">
                @can('products.update')
                <flux:button :href="route('products.edit', $product)" variant="primary" wire:navigate>{{ __('Edit') }}</flux:button>
                @endcan
                @can('products.delete')
                <form method="POST" action="{{ route('products.destroy', $product) }}" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                    @csrf
                    @method('DELETE')
                    <flux:button type="submit" variant="danger">{{ __('Delete') }}</flux:button>
                </form>
                @endcan
            </div>
        </div>

        @if(session('success'))
            <flux:card class="mb-6 !border-green-500 !bg-green-50 dark:!bg-green-950/30">
                <p class="text-green-700 dark:text-green-400 text-sm">{{ session('success') }}</p>
            </flux:card>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <flux:card>
                    <flux:heading size="lg" class="mb-4">{{ __('Description') }}</flux:heading>
                    <p class="text-zinc-600 dark:text-zinc-400">{{ $product->description ?? __('No description provided') }}</p>
                </flux:card>

                <flux:card>
                    <flux:heading size="lg" class="mb-4">{{ __('Pricing') }}</flux:heading>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-4 rounded-lg bg-zinc-100 dark:bg-white/10">
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Price ex. tax') }}</p>
                            <p class="text-xl font-bold text-zinc-800 dark:text-zinc-200">€{{ number_format($product->price_excl_tax, 2) }}</p>
                        </div>
                        <div class="p-4 rounded-lg bg-zinc-100 dark:bg-white/10">
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Tax rate') }}</p>
                            <p class="text-xl font-bold text-zinc-800 dark:text-zinc-200">{{ $product->tax }}%</p>
                        </div>
                        <div class="p-4 rounded-lg bg-zinc-100 dark:bg-white/10">
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Price inc. tax') }}</p>
                            <p class="text-xl font-bold text-zinc-800 dark:text-zinc-200">€{{ number_format($product->price_incl_tax, 2) }}</p>
                        </div>
                    </div>
                </flux:card>

                <flux:card>
                    <flux:heading size="lg" class="mb-4">{{ __('Stock') }}</flux:heading>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Available stock') }}</p>
                            <p class="text-2xl font-bold text-zinc-800 dark:text-zinc-200">{{ $product->available_stock }}</p>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Safety stock') }}</p>
                            <p class="text-2xl font-bold text-zinc-800 dark:text-zinc-200">{{ $product->safety_stock }}</p>
                        </div>
                    </div>
                    @if($product->isLowStock())
                        <flux:badge color="red" class="mt-4">{{ __('Low stock alert') }}</flux:badge>
                    @endif
                    <div class="mt-4 p-3 rounded-lg bg-zinc-100 dark:bg-white/10">
                        <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Unit') }}</p>
                        <p class="font-medium text-zinc-800 dark:text-zinc-200">{{ $product->unit }}</p>
                    </div>
                </flux:card>
            </div>

            <div class="space-y-6">
                <flux:card>
                    <flux:heading size="lg" class="mb-4">{{ __('Statistics') }}</flux:heading>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 rounded-lg bg-zinc-100 dark:bg-white/10">
                            <span class="text-zinc-600 dark:text-zinc-400 text-sm">{{ __('Sold') }}</span>
                            <span class="font-bold text-zinc-800 dark:text-zinc-200">{{ $product->sales_count }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-lg bg-zinc-100 dark:bg-white/10">
                            <span class="text-zinc-600 dark:text-zinc-400 text-sm">{{ __('Views') }}</span>
                            <span class="font-bold text-zinc-800 dark:text-zinc-200">{{ $product->views_count }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-lg bg-zinc-100 dark:bg-white/10">
                            <span class="text-zinc-600 dark:text-zinc-400 text-sm">{{ __('Rating') }}</span>
                            <span class="font-bold text-zinc-800 dark:text-zinc-200">{{ number_format($product->average_rating, 1) }}★</span>
                        </div>
                        @if($product->views_count > 0)
                            <div class="p-3 rounded-lg bg-zinc-100 dark:bg-white/10">
                                <p class="text-zinc-500 dark:text-zinc-400 text-sm">{{ __('Conversion') }}</p>
                                <p class="font-bold text-zinc-800 dark:text-zinc-200">{{ number_format($product->getConversionRate(), 1) }}%</p>
                            </div>
                        @endif
                    </div>
                </flux:card>

                <flux:card>
                    <flux:heading size="lg" class="mb-4">{{ __('Details') }}</flux:heading>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-zinc-500 dark:text-zinc-400">{{ __('Created') }}:</span> <span class="text-zinc-800 dark:text-zinc-200">{{ $product->created_at->format('d/m/Y H:i') }}</span></p>
                        <p><span class="text-zinc-500 dark:text-zinc-400">{{ __('Updated') }}:</span> <span class="text-zinc-800 dark:text-zinc-200">{{ $product->updated_at->format('d/m/Y H:i') }}</span></p>
                    </div>
                </flux:card>
            </div>
        </div>

        <div class="mt-8">
            <flux:button :href="route('products.index')" variant="ghost" wire:navigate>← {{ __('Back to products') }}</flux:button>
        </div>
    </div>
</x-app-layout>
