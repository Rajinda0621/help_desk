

<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Ticket') }}
            </h2>
        </x-slot>
        {{-- <h1 class="text-white text-lg font-bold">Create new support ticket</h1> --}}
        <div class="w-full sm:max-w-xl mt-1 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('ticket.store')}}" enctype="multipart/form-data">
                @csrf
                
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input placeholder="Add title" id="title" class="block mt-1 w-full" type="text" name="title" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea placeholder="Add description" name="description" id="description" value="" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                {{-- Dropdown --}}
                <div class="mt-4">
                    
                    <x-department-dropdown :departments="$departments" />

                    <script>
                        $(document).ready(function() {
                            $.get("{{ route('departments.fetch') }}", function(data) {
                                // Assuming the view returns the dropdown HTML
                                $("#dept_select").html(data);
                            });
                        });
                    </script>


                </div>

                <div class="mt-4">
                        <x-input-label for="attachment" :value="__('Attachment (if any)')" />
                        <x-file-input name="attachment" id="attachment" />
                        <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>


                {{-- Priority level radio button --}}
                <div class="mt-4">
                    <x-input-label for="priority" :value="__('Priority Level')" />
                    <div class="flex items-center mt-2">
                        <label class="mr-4 ml-2 text-white">
                            <input type="radio" name="priority" value="low" class="mr-2 ml-2" /> Low 
                        </label>
                        <label class="mr-4 ml-2 text-white">
                            <input type="radio" name="priority" value="high" class="mr-2 ml-2" /> High 
                        </label>
                        <label class="ml-2 text-white">
                            <input type="radio" name="priority" value="urgent" class="mr-2 ml-2" /> Urgent 
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                </div>

                
                        

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        Create
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>