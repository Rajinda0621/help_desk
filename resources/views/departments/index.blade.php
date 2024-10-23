
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

                    <div class="mt-5 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        <table class="min-w-full bg-white dark:bg-gray-800 mx-auto">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">ID</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Name</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Head of Department</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-700">
                                @foreach ($departments as $department)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $department->id }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $department->name }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ optional($department->headOfDepartment)->name ?? 'None' }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            <a href="{{ route('departments.edit', $department->id) }}" class="text-blue-500 dark:text-yellow-300 hover:underline">Edit</a>

                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                                            </form>

                                            <form action="{{ route('departments.assignHead', $department->id) }}" method="POST" class="mt-2 inline-block">
                                                @csrf
                                                <select name="user_id" class="border rounded p-1 text-black">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ $department->head_of_department_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-primary-button class="ml-2">
                                                    {{ __('Assign') }}
                                                </x-primary-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $departments->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

