<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('User Details') }}
            </h1>
            <a href="{{ route('users.index') }}" 
               class="px-5 py-2.5 rounded-lg text-sm font-semibold border transition-all duration-300"
               style="border-color:#E5E5E5; color:#666666;"
               onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                ← {{ __('Back to Users') }}
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-xl"
                 style="background-color:#FFFFFF; border:1px solid #D4AF37; color:#0A0A0A;">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" style="color:#D4AF37;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- User Info Card -->
        <div class="rounded-2xl overflow-hidden mb-6"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
            
            <div class="p-8">
                <div class="flex items-start justify-between">
                    <!-- User Avatar & Basic Info -->
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold"
                             style="background-color:#D4AF37; color:#0A0A0A;">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color:#0A0A0A;">
                                {{ $user->name }}
                            </h2>
                            <p class="text-sm mt-1" style="color:#666666;">
                                {{ $user->email }}
                            </p>
                            <div class="mt-3">
                                @foreach($user->getRoleNames() as $role)
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold"
                                          style="background-color:#D4AF37; color:#0A0A0A;">
                                        {{ $role }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        @can('users.update')
                            <a href="{{ route('users.edit', $user) }}"
                               class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                               style="border-color:#D4AF37; color:#D4AF37;"
                               onmouseover="this.style.backgroundColor='#D4AF37'; this.style.color='#0A0A0A';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D4AF37';">
                                {{ __('Edit') }}
                            </a>
                        @endcan
                        
                        @can('users.delete')
                            @if(auth()->id() !== $user->id)
                                <form method="POST" 
                                      action="{{ route('users.destroy', $user) }}"
                                      onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-300"
                                            style="border-color:#EF4444; color:#EF4444;"
                                            onmouseover="this.style.backgroundColor='#EF4444'; this.style.color='#FFFFFF';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#EF4444';">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    <!-- Email -->
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Email Address') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            {{ $user->email }}
                        </p>
                    </div>

                    <!-- Created At -->
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Member Since') }}
                        </p>
                        <p class="font-semibold" style="color:#0A0A0A;">
                            {{ $user->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="border-t" style="border-color:#E5E5E5;">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('User ID') }}
                        </p>
                        <p class="font-mono text-sm" style="color:#0A0A0A;">
                            #{{ $user->id }}
                        </p>
                    </div>
                    <div class="p-6 border-r" style="border-color:#E5E5E5;">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Email Verified') }}
                        </p>
                        <span class="inline-flex px-2 py-1 rounded text-xs font-semibold
                            @if($user->email_verified_at) 
                                style="background-color:#D4EDDA; color:#155724;"
                            @else 
                                style="background-color:#FFF3CD; color:#856404;"
                            @endif">
                            @if($user->email_verified_at)
                                {{ __('Yes') }}
                            @else
                                {{ __('No') }}
                            @endif
                        </span>
                    </div>
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-wider mb-1" style="color:#666666;">
                            {{ __('Last Updated') }}
                        </p>
                        <p class="font-semibold text-sm" style="color:#0A0A0A;">
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
