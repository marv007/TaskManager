<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Options</th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>                        
                            <td>{{$user->name}} </td>
                            <td>{{$user->email}} </td>
                            <td>                                
                                <a href="{{ URL::route('tasks', $user->id) }}" class="btn btn-warning"> View tasks </a>
                                <a href="{{ URL::route('dashboard') }}" class="btn btn-warning"> Edit </a>
                                @if(@Auth::user()->id != $user->id)
                                <a href="{{ URL::route('dashboard') }}" class="btn btn-warning"> Delete </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
