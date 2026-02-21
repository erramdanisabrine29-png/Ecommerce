<x-app-layout>
<div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F5F5F5; font-family: 'Inter', sans-serif;">

    <!-- Header -->
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-bold text-[#1F1F1F] tracking-wide">Stores</h1>
        @can('stores.create')
            <a href="{{ route('stores.create') }}"
               class="px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300"
               style="background-color:#C9A227; color:#fff;"
               onmouseover="this.style.backgroundColor='#B5961F';"
               onmouseout="this.style.backgroundColor='#C9A227';">
               Create store
            </a>
        @endcan
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-8 p-6 rounded-2xl shadow"
             style="background-color:#FFF9E6; color:#1F1F1F;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stores Grid -->
    @if($stores->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stores as $store)
                <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col transition transform hover:-translate-y-1 hover:shadow-lg duration-300">

                    <h2 class="text-2xl font-semibold mb-3 text-[#1F1F1F]">{{ $store->name }}</h2>

                    <div class="space-y-2 text-sm mb-4 text-[#555555]">
                        <p><strong>URL:</strong>
                            <a href="{{ $store->url }}" target="_blank" class="text-[#C9A227] hover:underline">
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
                    <div class="p-3 rounded-lg mb-4 bg-[#F9F9F9]">
                        <p class="text-xs mb-1 text-[#555555]">API Key</p>
                        <div class="flex items-center gap-2">
                            <code class="flex-1 truncate px-2 py-1 rounded text-xs bg-[#EFEFEF] font-mono">{{ $store->api_key }}</code>
                            <button type="button"
                                    class="px-3 py-1 rounded-full text-xs font-semibold border transition"
                                    style="border-color:#C9A227; color:#C9A227;"
                                    onclick="navigator.clipboard.writeText('{{ $store->api_key }}').then(()=>alert('API key copied'))"
                                    onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                                Copy
                            </button>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-2 mt-auto">
                        <a href="{{ route('stores.show', $store) }}"
                           class="px-4 py-2 text-sm rounded-full border transition"
                           style="border-color:#C9A227; color:#C9A227;"
                           onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                           View
                        </a>
                        @can('stores.update')
                            <a href="{{ route('stores.edit', $store) }}"
                               class="px-4 py-2 text-sm rounded-full border transition"
                               style="border-color:#1F1F1F; color:#1F1F1F;"
                               onmouseover="this.style.backgroundColor='#1F1F1F'; this.style.color='#fff';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1F1F1F';">
                               Edit
                            </a>
                        @endcan
                        @can('stores.delete')
                            <form action="{{ route('stores.destroy', $store) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 text-sm rounded-full border transition"
                                        style="border-color:#EF4444; color:#EF4444;"
                                        onmouseover="this.style.backgroundColor='#EF4444'; this.style.color='#fff';"
                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#EF4444';">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>

                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $stores->links() }}</div>
    @else
        <div class="bg-white rounded-2xl shadow-lg text-center p-12">
            <h2 class="text-2xl font-semibold mb-4 text-[#1F1F1F]">No stores yet</h2>
            <p class="text-[#555555] mb-6">Create your first store to get started.</p>
            @can('stores.create')
                <a href="{{ route('stores.create') }}"
                   class="px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300"
                   style="background-color:#C9A227; color:#fff;"
                   onmouseover="this.style.backgroundColor='#B5961F';"
                   onmouseout="this.style.backgroundColor='#C9A227';">
                   Create store
                </a>
            @endcan
        </div>
    @endif

</div>
</x-app-layout>