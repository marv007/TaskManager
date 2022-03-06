<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ URL::route('add-tasks') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg mb-5"> Add task </a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-5">                
                @if(count($tasks)>0)
                <table class="min-w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Title</th>
                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Priority</th>
                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Description</th>
                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Options</th>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                        
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white max-w-xs overflow-hidden">{{$task->title}} </td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white max-w-xs overflow-hidden">{{$task->priority}} </td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white max-w-xs overflow-hidden">{{$task->description}} </td>
                            <td>                             
                                <a href="{{ URL::route('edit-task', $task->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900"> Edit </a>                                
                                <a href="{{ URL::route('trash-task', $task->id) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"> Delete </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h2>No tasks found.</h2>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
