
 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col items-center justify-center pt-6 sm:pt-0 bg-gray-100">
        {{-- <h1 class="text-gray-800 text-lg font-bold mt-10">Users List</h1> --}}

        <div class="mt-10 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{-- Search bar --}}
            <form method="GET" action="{{ route('users') }}" class="mb-4">
                <input type="text" name="search" placeholder="Search by name or role"
                       class="border rounded px-4 py-2 w-1/3 text-black"
                       value="{{ request('search') }}">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-full border border-slate-300 hover:border-slate-400">Search</button>
            </form>

            {{-- User Table --}}
            <table class="min-w-full bg-white dark:bg-gray-800 mx-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">ID</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Email</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Role</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Assign Role</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                    @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $user->id }}</td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $user->name }}</td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <form action="{{ route('users.assignRole', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" class="border border-gray-300 rounded p-1 text-black">
                                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                                    <option value="head_of_department" {{ $user->hasRole('head_of_department') ? 'selected' : '' }}>Head Of Department</option>
                                    <option value="support_staff" {{ $user->hasRole('support_staff') ? 'selected' : '' }}>Support Staff</option>
                                    <option value="super_admin" {{ $user->hasRole('super_admin') ? 'selected' : '' }}>Super Admin</option>
                                </select>
                                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">Assign</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $users->links() }} <!-- Laravel's pagination links -->
            </div>
        </div>
    </div>
</x-app-layout>
