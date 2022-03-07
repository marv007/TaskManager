<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 lg:py-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 mx-20">
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('update-user', $user->id) }}">
                    @csrf
                    @method('PUT')
            
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$user->email" required />
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
