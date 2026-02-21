<x-app-layout>

    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F5F0;">

        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-semibold tracking-wide" style="color:#111111;">
                {{ __('Stores') }}
            </h1>
            @can('stores.create')
                <a href="{{ route('stores.create') }}"
                   class="px-6 py-3 border-2 rounded-full text-sm font-semibold tracking-wider transition-all duration-300 hover:scale-105"
                   style="border-color:#C9A227; color:#C9A227;"
                   onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                   {{ __('Create store') }}
                </a>
            @endcan
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-2xl shadow-sm"
                 style="background-color:#EDE3D3; color:#111111;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stores List -->
        @if($stores->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($stores as $store)
                    <div class="rounded-2xl shadow-lg p-6 flex flex-col transition-all duration-300 hover:shadow-xl"
                         style="background-color:white;">

                        <!-- Store Name -->
                        <h2 class="text-2xl font-semibold mb-3" style="color:#111111;">
                            {{ $store->name }}
                        </h2>

                        <!-- Store Info -->
                        <div class="space-y-2 text-sm mb-4" style="color:#111111;">
                            <p><strong>URL:</strong> 
                                <a href="{{ $store->url }}" target="_blank" rel="noopener" class="text-[#C9A227] hover:underline">
                                    {{ Str::limit($store->url, 40) }}
                                </a>
                            </p>
                            <p><strong>SSL:</strong>
                                <span style="color: {{ $store->ssl_certificate_status === 'active' ? '#10B981' : ($store->ssl_certificate_status === 'expired' ? '#EF4444' : '#F59E0B') }};">
                                    {{ ucfirst($store->ssl_certificate_status) }}
                                </span>
                            </p>
                            <p><strong>Tax rate:</strong> {{ $store->tax_rate }}%</p>
                            <p><strong>Min. stock:</strong> {{ $store->minimum_stock }}</p>
                        </div>

                        <!-- API Key -->
                        <div class="p-3 rounded-lg mb-4" style="background-color:#EDE3D3;">
                            <p class="text-xs mb-1" style="color:#111111;">{{ __('API Key') }}</p>
                            <div class="flex items-center gap-2">
                                <code class="text-xs font-mono flex-1 truncate px-2 py-1 rounded" style="background-color:#F8F5F0;">{{ $store->api_key }}</code>
                                <button type="button"
                                        class="px-3 py-1 text-sm rounded-full border transition-all duration-300"
                                        style="border-color:#C9A227; color:#C9A227;"
                                        onclick="navigator.clipboard.writeText('{{ $store->api_key }}').then(()=>alert('{{ __('API key copied') }}'))"
                                        onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                                    {{ __('Copy') }}
                                </button>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap gap-2 mt-auto">
                            <a href="{{ route('stores.show', $store) }}"
                               class="px-4 py-2 text-sm rounded-full border transition-all duration-300"
                               style="border-color:#C9A227; color:#C9A227;"
                               onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                                {{ __('View') }}
                            </a>

                            @can('stores.update')
                                <a href="{{ route('stores.edit', $store) }}"
                                   class="px-4 py-2 text-sm rounded-full border transition-all duration-300"
                                   style="border-color:#111111; color:#111111;"
                                   onmouseover="this.style.backgroundColor='#111111'; this.style.color='#fff';"
                                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111111';">
                                    {{ __('Edit') }}
                                </a>
                            @endcan

                            @can('stores.delete')
                                <form action="{{ route('stores.destroy', $store) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 text-sm rounded-full border transition-all duration-300"
                                            style="border-color:#EF4444; color:#EF4444;"
                                            onmouseover="this.style.backgroundColor='#EF4444'; this.style.color='#fff';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#EF4444';">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endcan
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-6">{{ $stores->links() }}</div>

        @else
            <div class="rounded-2xl shadow-lg text-center p-12" style="background-color:white;">
                <h2 class="text-2xl font-semibold mb-4" style="color:#111111;">{{ __('No stores yet') }}</h2>
                <p class="text-[#111111] mb-6">{{ __('Create your first store to get started.') }}</p>
                @can('stores.create')
                    <a href="{{ route('stores.create') }}"
                       class="px-6 py-3 border-2 rounded-full text-sm font-semibold tracking-wider transition-all duration-300 hover:scale-105"
                       style="border-color:#C9A227; color:#C9A227;"
                       onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                       {{ __('Create store') }}
                    </a>
                @endcan
            </div>
        @endif

    </div>

</x-app-layout>