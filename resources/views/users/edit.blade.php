<x-layouts.app>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm p-6 rounded-lg">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Nom</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label>Rôle</label>
                    <select name="role" class="w-full border rounded px-3 py-2" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Mettre à jour
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
