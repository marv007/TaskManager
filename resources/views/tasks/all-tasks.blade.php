<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ URL::route('add-tasks') }}" class="btn btn-warning"> Add task </a>
                @if(count($tasks)>0)
                <table class="table table-hover">
                    <thead>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Description</th>
                        <th>Options</th>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>                        
                            <td>{{$task->title}} </td>
                            <td>{{$task->priority}} </td>
                            <td>{{$task->description}} </td>
                            <td>                             
                                <a href="{{ URL::route('edit-task', $task->id) }}" class="btn btn-warning"> Edit </a>                                
                                <a href="{{ URL::route('trash-task', $task->id) }}" class="btn btn-warning"> Delete </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>No tasks found</h3>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
