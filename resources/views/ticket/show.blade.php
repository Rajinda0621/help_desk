{{-- 
<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1 class="text-gray-800 text-2xl font-bold mb-6">{{ $ticket->title }}</h1>

        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Ticket Details</h2>
                <span class="text-sm text-gray-500 dark:text-gray-400">Description:</span>
                <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $ticket->description }}</p>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created At:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ $ticket->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Priority:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ ucfirst($ticket->priority) }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Status:</span>
                    <form action="{{ route('ticket.resolve', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="rounded-md border-gray-300 dark:bg-gray-700">
                            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <x-primary-button>Update</x-primary-button>
                    </form>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Attachment:</span>
                    @if ($ticket->attachment)
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-500 underline">View Attachment</a>
                    @else
                        <p class="text-gray-500">No Attachment</p>
                    @endif
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Required Date:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($ticket->required_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Required Time:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($ticket->required_time)->format('H:i') }}</p>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('ticket.edit', $ticket->id) }}">
                    <x-primary-button>Edit</x-primary-button>
                </a>
                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                    @csrf
                    @method('delete')
                    <x-danger-button>Delete</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1 class="text-gray-800 text-2xl font-bold mb-6">{{ $ticket->title }}</h1>

        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Ticket Details</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $ticket->description }}</p>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created At:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ $ticket->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Priority:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ ucfirst($ticket->priority) }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Status:</span>
                    <form x-data="{ open: false }" action="{{ route('ticket.resolve', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="rounded-md border-gray-300 dark:bg-gray-700" x-on:change="open = (event.target.value === 'resolved')">
                            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <x-primary-button type="button" x-on:click="open = true">Update</x-primary-button>

                         
                        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full">
                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Confirm Resolution</h2>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to mark this ticket as resolved?</p>
                                <div class="flex justify-end space-x-4">
                                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" x-on:click="open = false">Cancel</button>
                                    <button type="submit" class="bg-green-600 text-black dark:text-white px-4 py-2 rounded-md ">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Attachment:</span>
                    @if ($ticket->attachment)
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-500 underline">View Attachment</a>
                    @else
                        <p class="text-gray-500">No Attachment</p>
                    @endif
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Required Date:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($ticket->required_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Required Time:</span>
                    <p class="text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($ticket->required_time)->format('H:i') }}</p>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('ticket.edit', $ticket->id) }}">
                    <x-primary-button>Edit</x-primary-button>
                </a>
                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                    @csrf
                    @method('delete')
                    <x-danger-button>Delete</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
