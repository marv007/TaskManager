<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Task') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 lg:py-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 mx-20">
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('add-task', $user_id) }}">
                    @csrf

                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="priority" value="{{ __('Priority') }}" />
                        <x-jet-input id="priority" class="block mt-1 w-full" type="text" name="priority" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" id="description" name="description" style="resize:none" required></textarea>                        
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        

                        <x-jet-button class="ml-4">
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
