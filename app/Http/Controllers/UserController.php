<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public static function index()
    {
        $users = User::all();
        
        return view('dashboard')
         ->with( 'users', $users);
    }

    public static function edit($id)
    {
        $user = User::where('id', $id)->get();
        if(count($user)==0){
            abort(404);
        }
        $user = $user[0]; 
        if(Auth::user()->id==$user->id || Auth::user()->hasRole('admin')){
            return view('user.edit-user')
         ->with( 'user', $user);
        } else {
            abort(404);
        }
    }

    public static function getById($id)
    {
        $user = User::where('id', $id)->get();
        if(count($user)==0){
            abort(404);
        }
        $user = $user[0]; 
        if(Auth::user()->id==$user->id || Auth::user()->hasRole('admin')){
            return  $user;
        } else {
            abort(404);
        }
    }

    public static function update(Request $request)
    {
        $user = User::where('id', $request->id)->get();
        $user = $user[0];
        $user->name = $request->name;
        $user->email = $request->email;        
       
        $user->save();

        return Redirect::route('dashboard');        
    }

    public static function trash($id)
    {
        $user = User::where('id', $id)->get();
        if(count($user)==0){
            abort(404);
        }
        $user = $user[0]; 
        if(Auth::user()->id==$user->id || Auth::user()->hasRole('admin')){
            return view('user.delete-user')
         ->with('user', $user);
        } else {
            abort(404);
        }
    }
    public static function delete($id)
    {
        $user_tasks = Task::where('user_id', $id)->delete();      
        $deleted= User::where('id', $id)->delete();

        return 'success';

        
    }
}
