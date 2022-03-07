<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class TaskController extends Controller
{
    public static function index()
    {
        $tasks = Task::all();
        
        return  $tasks;
    }

    public static function getByUserId($user_id)
    {
        $tasks = Task::where('user_id', $user_id)->get();             
        return $tasks;
    }

    public static function store(Request $request)
    {
        $task = Task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'priority' => $request->priority,
            'description' => $request->description
        ]);

        return $task;

        
    }

    public static function edit($id)
    {
        $task = Task::where('id', $id)->get();
        if(count($task)==0){
            abort(404);
        }
        $task = $task[0]; 
        if(Auth::user()->id==$task->user_id || Auth::user()->hasRole('admin')){
            return view('tasks.edit-task')
         ->with( 'task', $task);
        } else {
            abort(404);
        }
    }

    public static function update(Request $request)
    {
        $task = Task::where('id', $request->id)->get();
        $task = $task[0];
        $task->title = $request->title;
        $task->priority = $request->priority;
        $task->description = $request->description;
       
        $task->save();
        return $task;
                
    }

    public static function trash($id)
    {
        
        $task = Task::where('id', $id)->get();
        if(count($task)==0){
            abort(404);
        }
        $task = $task[0]; 
        if(Auth::user()->id==$task->user_id || Auth::user()->hasRole('admin')){
            return view('tasks.delete-task')
         ->with( 'task', $task);
        } else {
            abort(404);
        }             
        

        
    }

    public static function delete($id)
    {
        $task = Task::where('id', $id)->get();
        $task = $task[0];
        $deleted= Task::where('id', $id)->delete();

        return $task->user_id;

        
    }
}
