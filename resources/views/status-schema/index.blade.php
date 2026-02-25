<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">

        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-bold" style="color:#0A0A0A;">
                {{ __('Statuts de la commande') }}
            </h1>
        </div>

        <!-- Status Schema Card -->
        <div class="rounded-2xl overflow-hidden"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">

            <div class="p-8">
                <!-- Ligne horizontale premium -->
                <div class="w-full h-1 rounded-full mb-12" style="background: linear-gradient(90deg, #D4AF37 0%, #B8962E 50%, #0A0A0A 100%);"></div>

                @php
                    $statuses = [
                        ['01','New Order','📦'],
                        ['02','Confirmed','✅'],
                        ['03','No Answer','📵'],
                        ['04','Busy','📞'],
                        ['05','Cancelled','❌'],
                        ['06','Call Later','⏰'],
                        ['07','Livred','📦'],
                        ['08','Double Commande','🚚'],
                        ['09','Refused','🙅']
                    ];
                @endphp

                <div class="flex justify-between items-start relative">

                    @foreach($statuses as $index => $status)

                        <div class="flex flex-col items-center relative w-28">

                            {{-- Icon Top --}}
                            @if($index % 2 == 0)
                                <div class="mb-4 text-4xl">
                                    {{ $status[2] }}
                                </div>
                            @endif

                            {{-- Line Up --}}
                            <div class="w-1 h-6" style="background-color:#D4AF37;"></div>

                            {{-- Circle Luxe --}}
                            <div class="w-16 h-16 rounded-full flex items-center justify-center text-lg font-bold"
                                 style="background-color:#FFFFFF; border:2px solid #D4AF37; color:#D4AF37;">
                                {{ $status[0] }}
                            </div>

                            {{-- Line Down --}}
                            <div class="w-1 h-6" style="background-color:#D4AF37;"></div>

                            {{-- Icon Bottom --}}
                            @if($index % 2 != 0)
                                <div class="mt-4 text-4xl">
                                    {{ $status[2] }}
                                </div>
                            @endif

                            {{-- Label --}}
                            <p class="mt-3 text-xs text-center font-semibold uppercase tracking-wider" style="color:#0A0A0A;">
                                {{ $status[1] }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>
</x-app-layout>
