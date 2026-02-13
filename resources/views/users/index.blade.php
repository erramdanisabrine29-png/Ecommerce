<x-layouts.app>
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Créer un utilisateur
        </a>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border">Rôle</th>
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Nom</th>
                        <th class="py-2 px-4 border">Email</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="py-2 px-4 border">{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                            <td class="py-2 px-4 border">{{ $user->id }}</td>
                            <td class="py-2 px-4 border">{{ $user->name }}</td>
                            <td class="py-2 px-4 border">{{ $user->email }}</td>
                            <td class="py-2 px-4 border flex gap-2">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600">Modifier</a>

                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">
                                     Supprimer
                                    </button>
                                    </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
