<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1 class="text-gray-800 text-lg font-bold mb-4">{{ $ticket->title }}</h1>
        
        <!-- Container div with flex and centered alignment -->
        <div class="mt-1 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300" style="table-layout: fixed;">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Attachment</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-300">
                    <tr>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 dark:text-gray-200">
                            <textarea readonly style="width: 100%; height: 120px; resize: none; border: none; background-color: transparent; overflow-y: auto; padding: 0;">
                                {{ $ticket->description }}
                            </textarea>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $ticket->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $ticket->priority }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            @if ($ticket->attachment)
                                <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-500 underline underline-offset-5">View Attachment</a>
                            @else
                                <span class="text-gray-500">No Attachment</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 flex space-x-2">
                            <a href="{{ route('ticket.edit', $ticket->id) }}" class="ml-5">
                                <x-primary-button>Edit</x-primary-button>
                            </a>
                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                @csrf
                                @method('delete')
                                <x-primary-button class="mr-4">Delete</x-primary-button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
