{{-- 
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
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Department</th> 
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Attachment</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Assign To:</th>
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
                            {{ $ticket->department ? $ticket->department->name : 'No Department' }} 
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            @if($ticket->attachment)
                                <a href="{{ Storage::url($ticket->attachment) }}" class="text-blue-500 dark:text-yellow-300 hover:underline" target="_blank">View Attachment</a>
                            @else
                                <span class="text-gray-500">No attachment</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <form method="POST" action="{{ route('ticket.assign', $ticket->id) }}">
                                @csrf
                                <label for="support_staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Assign to Support Staff:</label>
                                <div class="mt-1 relative">
                                    <select name="support_staff_id" id="support_staff_id" class="block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($supportStaffUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="mt-2 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Assign
                                </button>
                            </form>
                            
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
</x-app-layout> --}}

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
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Department</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Attachment</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Assigned Staff</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Assign To:</th>
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
                            {{ $ticket->department ? $ticket->department->name : 'No Department' }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            @if($ticket->attachment)
                                <a href="{{ Storage::url($ticket->attachment) }}" class="text-blue-500 dark:text-yellow-300 hover:underline" target="_blank">View Attachment</a>
                            @else
                                <span class="text-gray-500">No attachment</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            {{ $ticket->supportStaff ? $ticket->supportStaff->name : 'Not Assigned' }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                            <form method="POST" action="{{ route('ticket.assign', $ticket->id) }}">
                                @csrf
                                <label for="support_staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Assign to Support Staff:</label>
                                <div class="mt-1 relative">
                                    <select name="support_staff_id" id="support_staff_id" class="block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($supportStaffUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="mt-2 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-black dark:text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Assign
                                </button>
                            </form>
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
