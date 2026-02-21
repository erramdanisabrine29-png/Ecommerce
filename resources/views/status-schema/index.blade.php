<x-app-layout>
    <div class="p-10 bg-[#f3f4f6] min-h-screen">

        <h1 class="text-3xl font-bold mb-16">
            Statuts de la commande
        </h1>

        <div class="relative">

            <!-- Ligne horizontale -->
            <div class="absolute top-24 left-0 right-0 h-1 bg-teal-600"></div>

            @php
                $statuses = [
                    ['01','New Order','📦'],
                    ['02','Confirmed','✅'],
                    ['03','No Answer','📵'],
                    ['04','Busy','📞'],
                    ['05','Cancelled','❌'],
                    ['06','Call Later','⏰'],
                    ['07','Livred','🪙'],
                    ['08','Double Commande','🚚'],
                    ['09','Refused','🙅']
                ];
            @endphp

            <div class="flex justify-between items-start relative">

                @foreach($statuses as $index => $status)

                    <div class="flex flex-col items-center relative w-32">

                        {{-- Icon Top --}}
                        @if($index % 2 == 0)
                            <div class="mb-6 text-5xl">
                                {{ $status[2] }}
                            </div>
                        @endif

                        {{-- Line Up --}}
                        <div class="w-1 h-8 bg-teal-600"></div>

                        {{-- Circle --}}
                        <div class="w-16 h-16 rounded-full bg-white border-4 border-teal-700 flex items-center justify-center text-2xl font-bold text-orange-500 shadow-md">
                            {{ $status[0] }}
                        </div>

                        {{-- Line Down --}}
                        <div class="w-1 h-8 bg-teal-600"></div>

                        {{-- Icon Bottom --}}
                        @if($index % 2 != 0)
                            <div class="mt-6 text-5xl">
                                {{ $status[2] }}
                            </div>
                        @endif

                        {{-- Label --}}
                        <p class="mt-4 text-sm text-center font-semibold uppercase tracking-wide">
                            {{ $status[1] }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </div>
</x-app-layout>