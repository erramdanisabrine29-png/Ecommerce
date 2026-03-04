<x-app-layout>
    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F8F8;">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold" style="color:#0A0A0A;">
                {{ __('Edit User') }}
            </h1>
            <a href="{{ route('users.index') }}" 
               class="px-5 py-2.5 rounded-lg text-sm font-semibold border transition-all duration-300"
               style="border-color:#E5E5E5; color:#666666;"
               onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                ← {{ __('Back') }}
            </a>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-8 p-6 rounded-xl"
                 style="background-color:#FFFFFF; border:1px solid #EF4444; box-shadow:0 10px 30px rgba(239,68,68,0.1);">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5" style="color:#EF4444;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold" style="color:#EF4444;">{{ __('Please fix the following errors:') }}</span>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1" style="color:#666666;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="rounded-2xl overflow-hidden"
             style="background-color:#FFFFFF; border:1px solid #E5E5E5; box-shadow:0 15px 40px rgba(0,0,0,0.05);">
            
            <div class="p-8">
                <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Full Name') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="{{ __('Enter full name') }}">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Email Address') }} <span style="color:#EF4444;">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="{{ __('Enter email address') }}">
                        </div>
                    </div>

                    <!-- Password Change Section -->
                    <div class="border-t pt-6" style="border-color:#E5E5E5;">
                        <h3 class="text-lg font-semibold mb-4" style="color:#0A0A0A;">
                            {{ __('Change Password') }}
                        </h3>
                        <p class="text-sm mb-4" style="color:#666666;">
                            {{ __('Leave blank if you don\'t want to change the password.') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('New Password') }}
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="{{ __('Enter new password') }}">
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                                {{ __('Confirm New Password') }}
                            </label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                   style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                   onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                   onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';"
                                   placeholder="{{ __('Confirm new password') }}">
                        </div>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-semibold mb-2" style="color:#0A0A0A;">
                            {{ __('Role') }} <span style="color:#EF4444;">*</span>
                        </label>
                        <select name="role" 
                                id="role" 
                                required
                                class="w-full px-4 py-3 rounded-xl border transition-all duration-300 focus:outline-none focus:ring-2"
                                style="border-color:#E5E5E5; color:#0A0A0A; background-color:#F8F8F8;"
                                onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.1)';"
                                onblur="this.style.borderColor='#E5E5E5'; this.style.boxShadow='none';">
                            <option value="" disabled>{{ __('Select a role') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('users.index') }}" 
                           class="px-6 py-3 rounded-xl text-sm font-semibold border transition-all duration-300"
                           style="border-color:#E5E5E5; color:#666666;"
                           onmouseover="this.style.backgroundColor='#F8F8F8'; this.style.border-color='#666666';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.border-color='#E5E5E5';">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300"
                                style="background-color:#D4AF37; color:#0A0A0A;"
                                onmouseover="this.style.backgroundColor='#B8962E';"
                                onmouseout="this.style.backgroundColor='#D4AF37';">
                            {{ __('Update User') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
