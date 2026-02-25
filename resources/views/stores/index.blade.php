<x-app-layout>

    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">

        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-bold" style="color:#0A0A0A;">
                {{ __('Stores Management') }}
            </h1>

            @can('stores.create')
                <a href="{{ route('stores.create') }}"
                   class="px-6 py-3 rounded-lg text-sm font-semibold transition-all duration-300"
                   style="background-color:#D4AF37; color:#0A0A0A;"
                   onmouseover="this.style.backgroundColor='#B8962E';"
                   onmouseout="this.style.backgroundColor='#D4AF37';">
                    {{ __('Create Store') }}
                </a>
            @endcan
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-2xl"
                 style="background-color:#FFFFFF; border:1px solid #D4AF37; color:#0A0A0A;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="rounded-2xl overflow-hidden"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <!-- Table Head -->
                    <thead style="background-color:#F8F8F8;">
                        <tr class="text-sm uppercase tracking-wider">
                            <th class="px-8 py-5 font-semibold" style="color:#0A0A0A;">Store Name</th>
                            <th class="px-8 py-5 font-semibold" style="color:#0A0A0A;">URL</th>
                            <th class="px-8 py-5 font-semibold" style="color:#0A0A0A;">API Key</th>
                            <th class="px-8 py-5 font-semibold" style="color:#0A0A0A;">SSL Status</th>
                            <th class="px-8 py-5 font-semibold" style="color:#0A0A0A;">Tax Rate</th>
                            <th class="px-8 py-5 font-semibold" style="color:#0A0A0A;">Shopify</th>
                            <th class="px-8 py-5 text-right font-semibold" style="color:#0A0A0A;">Actions</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>

                        @foreach($stores as $store)
                            <tr class="border-b transition-all duration-300" style="border-color:#E5E5E5;"
                                onmouseover="this.style.backgroundColor='#F8F8F8';"
                                onmouseout="this.style.backgroundColor='#FFFFFF';">

                                <td class="px-8 py-6 font-semibold" style="color:#0A0A0A;">
                                    {{ $store->name }}
                                </td>

                                <td class="px-8 py-6 text-sm" style="color:#666666;">
                                    {{ $store->url }}
                                </td>

                                <td class="px-8 py-6 text-sm font-mono" style="color:#0A0A0A;">
                                    {{ Str::limit($store->api_key, 20) }}
                                </td>

                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                          style="background-color: {{ $store->ssl_certificate_status === 'active' ? '#D4EDDA' : '#F8D7DA' }};
                                                 color: {{ $store->ssl_certificate_status === 'active' ? '#155724' : '#721C24' }};">
                                        {{ ucfirst($store->ssl_certificate_status) }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-sm" style="color:#0A0A0A;">
                                    {{ $store->tax_rate }}%
                                </td>

                                <td class="px-8 py-6">
                                    @if($store->shopify_connected_at)
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                              style="background-color:#D4EDDA; color:#155724;">
                                            Connected
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                              style="background-color:#FFF3CD; color:#856404;">
                                            Not Connected
                                        </span>
                                    @endif
                                </td>

                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3">

                                        @can('stores.read')
                                            <a href="{{ route('stores.show', $store) }}"
                                               class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                               style="border-color:#666666; color:#666666;"
                                               onmouseover="this.style.backgroundColor='#666666'; this.style.color='#FFFFFF';"
                                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#666666';">
                                                View
                                            </a>
                                        @endcan

                                        @can('stores.update')
                                            <a href="{{ route('stores.edit', $store) }}"
                                               class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                               style="border-color:#D4AF37; color:#D4AF37;"
                                               onmouseover="this.style.backgroundColor='#D4AF37'; this.style.color='#0A0A0A';"
                                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D4AF37';">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('stores.delete')
                                            <form method="POST"
                                                  action="{{ route('stores.destroy', $store) }}"
                                                  onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                                        style="border-color:#0A0A0A; color:#0A0A0A;"
                                                        onmouseover="this.style.backgroundColor='#0A0A0A'; this.style.color='#FFFFFF';"
                                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#0A0A0A';">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

            <!-- Pagination -->
            <div class="px-8 py-6 border-t" style="background-color:#F8F8F8; border-color:#E5E5E5;">
                {{ $stores->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
