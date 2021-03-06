<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 lg:py-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 mx-20">
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('update-task', $task->id) }}">
                    @csrf
                    @method('PUT')
            
                    <div>
                        <x-jet-label for="name" value="{{ __('Title') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="title" :value="$task->title" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Priority') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="priority" :value="$task->priority" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Description') }}" />
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" id="description" name="description" style="resize:none" value="$task->description" required>{{$task->description}}</textarea>
                        
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
