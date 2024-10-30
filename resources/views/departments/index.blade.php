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

                    <!-- Button positioned above the table -->
                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('departments.create') }}" 
                            class="bg-blue-500 text-black  dark:text-white px-4 py-2 rounded border border-slate-300 hover:border-slate-400">
                            + Add Department
                        </a>
                    </div>

                    <div class="px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        <!-- Full width table -->
                        <table class="w-full min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-gray-600 dark:text-gray-200">Name</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-gray-600 dark:text-gray-200">Head of Department</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-gray-600 dark:text-gray-200">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-700">
                                @foreach ($departments as $department)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $department->name }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ optional($department->headOfDepartment)->name ?? 'None' }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            <a href="{{ route('departments.edit', $department->id) }}" class="text-blue-500 dark:text-yellow-300 hover:underline">Edit</a>

                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                            </form>

                                            <form action="{{ route('departments.assignHead', $department->id) }}" method="POST" class="mt-2 inline-block">
                                                @csrf
                                                <div class="flex items-center space-x-2 w-full">
                                                    <select name="user_id" class="border rounded p-1 text-black w-full">
                                                        @foreach ($users as $user)
                                                            @if ($user->hasRole('head_of_department'))
                                                                <option value="{{ $user->id }}" {{ $department->head_of_department_id == $user->id ? 'selected' : '' }} title="{{ $user->name }}">
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                
                                                    <x-primary-button class="ml-2">
                                                        {{ __('Assign') }}
                                                    </x-primary-button>
                                                </div>
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
