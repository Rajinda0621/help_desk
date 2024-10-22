<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Departments List</h3>

                    <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded border border-slate-300 hover:border-slate-400 ">+ Add Department</a>

                    <table class="min-w-full table-auto mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Head of Department</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td class="border px-4 py-2">{{ $department->id }}</td>
                                    <td class="border px-4 py-2">{{ $department->name }}</td>
                                    <td class="border px-4 py-2">{{ optional($department->headOfDepartment)->name ?? 'None' }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('departments.edit', $department->id) }}" class="text-blue-500">Edit</a>
                                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>

                                        {{-- Assign Head of Department --}}
                                        <form action="{{ route('departments.assignHead', $department->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            <select name="user_id" class="border rounded p-1 text-black">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ $department->head_of_department_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">Assign</button> --}}
                                            <x-primary-button class="ms-3">
                                                {{ __('Assign') }}
                                            </x-primary-button>
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
