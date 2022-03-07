<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delete User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 lg:py-6">
            <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600 mx-20">Are you sure?</h2>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 mx-20 ">
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('delete-user', $user->id) }}">
                    @csrf
                    @method('DELETE')
            
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" disabled/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$user->email" disabled />
                    </div>

                    


                    <div class="flex items-center justify-end mt-4">
                        

                        <x-jet-button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            {{ __('Delete') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
