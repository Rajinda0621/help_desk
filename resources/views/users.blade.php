{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

   
</x-app-layout> --}}

{{-- User assign test --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Users List</h3>

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Assign Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->id }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td class="border px-4 py-2">
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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

