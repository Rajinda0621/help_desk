<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 animate__animated animate__fadeIn">
                    <h1 class="text-2xl font-bold mb-4">Welcome to the Dashboard!</h1>
                    <p class="mb-6">Here you can manage your tickets and view your activities.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-blue-500 text-white p-4 rounded-lg shadow transition-transform transform hover:scale-105 hover:shadow-lg animate__animated animate__zoomIn">
                            <h3 class="font-bold text-lg">Total Tickets</h3>
                            <p class="text-2xl">45</p> 
                        </div>
                        <div class="bg-green-500 text-white p-4 rounded-lg shadow transition-transform transform hover:scale-105 hover:shadow-lg animate__animated animate__zoomIn">
                            <h3 class="font-bold text-lg">Open Tickets</h3>
                            <p class="text-2xl">23</p> 
                        </div>
                        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow transition-transform transform hover:scale-105 hover:shadow-lg animate__animated animate__zoomIn">
                            <h3 class="font-bold text-lg">Resolved Tickets</h3>
                            <p class="text-2xl">12</p> 
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold">Recent Activities</h3>
                        <ul class="mt-4 space-y-2">
                            <li class="p-4 bg-gray-100 text-black rounded-lg shadow transition-opacity duration-500 ease-in-out opacity-0" x-data="{ show: false }" x-init="show = true" x-bind:class="{ 'opacity-100 animate__animated animate__fadeIn': show }">User A created a ticket titled "Issue with login"</li>
                            <li class="p-4 bg-gray-100 text-black rounded-lg shadow transition-opacity duration-500 ease-in-out opacity-0" x-data="{ show: false }" x-init="show = true" x-bind:class="{ 'opacity-100 animate__animated animate__fadeIn': show }">User B updated the ticket titled "Bug in dashboard"</li>
                            <li class="p-4 bg-gray-100 text-black rounded-lg shadow transition-opacity duration-500 ease-in-out opacity-0" x-data="{ show: false }" x-init="show = true" x-bind:class="{ 'opacity-100 animate__animated animate__fadeIn': show }">User C resolved the ticket titled "Password reset"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
