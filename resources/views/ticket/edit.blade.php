<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <h1 class="text-gray-800 text-lg font-bold">Update support ticket</h1>
        <div class="w-full sm:max-w-xl mt-1 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('ticket.update', $ticket->id )}}" enctype="multipart/form-data">
                @csrf

                @method('patch')
                
                
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input value="{{ old('title', $ticket->title) }}"  id="title" class="block mt-1 w-full" type="text" name="title" autofocus/>
  
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea placeholder="Add description" name="description" id="description" 
                    value="{{ $ticket->description}}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                
                <div class="mt-4">
                    @if ($ticket->attachment)
                        <a href="{{' \storage\app\public\attachments\ '. ($ticket->attachment)}}" target="_blank" class="text-white underline underline-offset-5">See attachment</a>
                    @endif 
                    <x-input-label for="attachment" :value="__('Attachment (if any)')" />
                    <x-file-input name="attachment" id="attachment" />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                
                        

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        Update
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>