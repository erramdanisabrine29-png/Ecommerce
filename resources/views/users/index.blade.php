<x-app-layout>

    <div class="min-h-screen py-12 px-6 lg:px-16" style="background-color:#F8F5F0;">

        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-semibold tracking-wide" style="color:#111111;">
                {{ __('Users Management') }}
            </h1>

            @can('users.create')
                <a href="{{ route('users.create') }}"
                   class="px-6 py-3 border-2 rounded-full text-sm font-semibold tracking-wider transition-all duration-300 hover:scale-105"
                   style="border-color:#C9A227; color:#C9A227;"
                   onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                    {{ __('Create User') }}
                </a>
            @endcan
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-2xl shadow-sm"
                 style="background-color:#EDE3D3; color:#111111;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="rounded-3xl shadow-lg overflow-hidden"
             style="background-color:white;">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <!-- Table Head -->
                    <thead style="background-color:#EDE3D3;">
                        <tr class="text-sm uppercase tracking-wider">
                            <th class="px-8 py-5" style="color:#111111;">Role</th>
                            <th class="px-8 py-5" style="color:#111111;">ID</th>
                            <th class="px-8 py-5" style="color:#111111;">Name</th>
                            <th class="px-8 py-5" style="color:#111111;">Email</th>
                            <th class="px-8 py-5 text-right" style="color:#111111;">Actions</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>

                        @foreach($users as $user)
                            <tr class="border-b transition-all duration-300 hover:bg-[#F8F5F0]">

                                <td class="px-8 py-6 text-sm" style="color:#111111;">
                                    {{ implode(', ', $user->getRoleNames()->toArray()) }}
                                </td>

                                <td class="px-8 py-6 text-sm" style="color:#111111;">
                                    {{ $user->id }}
                                </td>

                                <td class="px-8 py-6 font-medium" style="color:#111111;">
                                    {{ $user->name }}
                                </td>

                                <td class="px-8 py-6 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>

                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3">

                                        @can('users.update')
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="px-4 py-2 text-xs font-semibold rounded-full border transition-all duration-300"
                                               style="border-color:#C9A227; color:#C9A227;"
                                               onmouseover="this.style.backgroundColor='#C9A227'; this.style.color='#fff';"
                                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#C9A227';">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('users.delete')
                                            <form method="POST"
                                                  action="{{ route('users.destroy', $user) }}"
                                                  onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-4 py-2 text-xs font-semibold rounded-full border transition-all duration-300"
                                                        style="border-color:#111111; color:#111111;"
                                                        onmouseover="this.style.backgroundColor='#111111'; this.style.color='#fff';"
                                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111111';">
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
            <div class="px-8 py-6 border-t" style="background-color:#F8F5F0;">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</x-app-layout>