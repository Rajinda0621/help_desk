{{-- <x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center pt-6 sm:pt-0 bg-gray-100">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket Logs') }}
            </h2>
        </x-slot>

        <h1 class="text-gray-800 text-lg font-bold mt-10">Support Tickets</h1>

        <div class="mt-5 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <table class="min-w-full bg-white dark:bg-gray-800 mx-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Title</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Created At</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Priority</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Attachment</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <a href="{{ route('ticket.show', $ticket->id) }}" class="text-blue-500 dark:text-yellow-300 hover:underline">{{ $ticket->title }}</a>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            {{ $ticket->created_at->diffForHumans() }}
                        </td>
                        
                        
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium 
                                @if(strtolower($ticket->priority) == 'low') bg-green-100 text-green-800 
                                @elseif(strtolower($ticket->priority) == 'high') bg-yellow-100 text-yellow-800 
                                @elseif(strtolower($ticket->priority) == 'urgent') bg-red-100 text-red-800 
                                @else bg-gray-200 text-gray-600 @endif">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            @if($ticket->attachment)
                                <a href="{{ asset('storage/' . $ticket->attachment) }}" class="text-blue-500 dark:text-yellow-300 hover:underline" target="_blank">View Attachment</a>
                            @else
                                <span class="text-gray-500">No attachment</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            
            <div class="mt-4">
                {{ $tickets->links() }} 
            </div>
        </div>
    </div>
</x-app-layout>
 --}}
 <x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center pt-6 sm:pt-0 bg-gray-100">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket Logs') }}
            </h2>
        </x-slot>

        <h1 class="text-gray-800 text-lg font-bold mt-10">Support Tickets</h1>

        <div class="mt-5 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <table class="min-w-full bg-white dark:bg-gray-800 mx-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Title</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Created At</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Priority</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Department ID</th> <!-- New Column -->
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Attachment</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <a href="{{ route('ticket.show', $ticket->id) }}" class="text-blue-500 dark:text-yellow-300 hover:underline">{{ $ticket->title }}</a>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            {{ $ticket->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <span class="{{ $ticket->getPriorityClasses() }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            {{ $ticket->department ? $ticket->department->name : 'No Department' }} <!-- Display department name -->
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            @if($ticket->attachment)
                                <a href="{{ Storage::url($ticket->attachment) }}" class="text-blue-500 dark:text-yellow-300 hover:underline" target="_blank">View Attachment</a>
                            @else
                                <span class="text-gray-500">No attachment</span>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $tickets->links() }} <!-- Laravel's pagination links -->
            </div>
        </div>
    </div>
</x-app-layout>
