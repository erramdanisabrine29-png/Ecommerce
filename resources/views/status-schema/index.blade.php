<x-app-layout>
    <div class="p-10 bg-[#f8f6f0] min-h-screen font-sans">

        <h1 class="text-4xl font-extrabold mb-16 text-gray-900 tracking-wide">
            Statuts de la commande
        </h1>

        <div class="relative">

            <!-- Ligne horizontale premium -->
            <div class="absolute top-28 left-0 right-0 h-1 bg-gradient-to-r from-[#d8cfc4] via-[#bfae9f] to-[#1a1a1a] rounded-full shadow-sm"></div>

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

            <div class="flex justify-between items-start relative mt-10">

                @foreach($statuses as $index => $status)

                    <div class="flex flex-col items-center relative w-36">

                        {{-- Icon Top --}}
                        @if($index % 2 == 0)
                            <div class="mb-6 text-5xl">
                                {{ $status[2] }}
                            </div>
                        @endif

                        {{-- Line Up --}}
                        <div class="w-1 h-10 bg-[#bfae9f]"></div>

                        {{-- Circle Luxe --}}
                        <div class="w-20 h-20 rounded-full bg-[#fffdf7] border-2 border-[#1a1a1a] flex items-center justify-center text-2xl font-bold text-[#bfae9f] shadow-lg">
                            {{ $status[0] }}
                        </div>

                        {{-- Line Down --}}
                        <div class="w-1 h-10 bg-[#bfae9f]"></div>

                        {{-- Icon Bottom --}}
                        @if($index % 2 != 0)
                            <div class="mt-6 text-5xl">
                                {{ $status[2] }}
                            </div>
                        @endif

                        {{-- Label --}}
                        <p class="mt-4 text-sm text-center font-medium uppercase tracking-wider text-gray-800">
                            {{ $status[1] }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </div>
</x-app-layout>