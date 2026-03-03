<x-app-layout>
    <div class="p-6 lg:p-8 max-w-2xl mx-auto">
        <h2 class="text-xl font-bold mb-6">{{ __('Create user') }}</h2>

        @if($errors->any())
            <div class="bg-red-50 border border-red-500 text-red-700 p-4 mb-4 rounded">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block font-medium mb-1">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="email" class="block font-medium mb-1">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="password" class="block font-medium mb-1">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="password_confirmation" class="block font-medium mb-1">{{ __('Confirm Password') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="role" class="block font-medium mb-1">{{ __('Role') }}</label>
                <select name="role" id="role" required class="w-full border rounded px-3 py-2">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3 mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ __('Create') }}
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-200 px-4 py-2 rounded">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-app-layout>