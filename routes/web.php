<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {    
    if(Auth::user()->hasRole('admin')){        
        return UserController::index();        
    }else{        
         return Redirect::route('tasks', Auth::user()->id);
    }
   
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/tasks/{user_id}', 
function ($user_id) {
    if(Auth::user()->hasRole('admin') || Auth::user()->id==$user_id){
        $tasks = TaskController::getByUserId($user_id);
        $user = UserController::getById($user_id);
        return view('tasks.all-tasks')
        ->with( 'tasks', $tasks)->with('user', $user);
    }else{
        abort(404);        
    }
    
}
)->name('tasks');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-task/{user_id}', 
function ($user_id) {
    //return View::make('tasks\add-task');
     return view('tasks.add-task')
    ->with( 'user_id', $user_id); 
}
)->name('add-task');

Route::middleware(['auth:sanctum', 'verified'])->post('/add-task/{user_id}', 
function ($user_id, Request $request){
    $request-> user_id = $user_id;
    $task= TaskController::store($request);
    return Redirect::route('tasks', $task->user_id); 
}
)->name('add-task');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-task/{id}', 
function ($id) {
    return TaskController::edit($id);
}
)->name('edit-task');



Route::middleware(['auth:sanctum', 'verified'])->put('/update-task/{id}', 
function ($id, Request $request){
    $request->id = $id;
    $task=  TaskController::update($request);
    return Redirect::route('tasks', $task->user_id);
}
)->name('update-task');

Route::middleware(['auth:sanctum', 'verified'])->get('/delete-task/{id}', 
function ($id){
    return TaskController::trash($id);
}
)->name('trash-task');

Route::middleware(['auth:sanctum', 'verified'])->delete('/delete-task/{id}', 
function ($id){    
    $user_id = TaskController::delete($id);
    return Redirect::route('tasks', $user_id);
}
)->name('delete-task');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-user/{id}', 
function ($id) {
    return UserController::edit($id);
}
)->name('edit-user');

Route::middleware(['auth:sanctum', 'verified'])->put('/update-user/{id}', 
function ($id, Request $request){
    $request->id = $id;
    return UserController::update($request);
}
)->name('update-user');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete-user/{id}', 
function ($id){    
    return UserController::trash($id);    
}
)->name('trash-user');

Route::middleware(['auth:sanctum', 'verified'])->delete('/delete-user/{id}', 
function ($id){    
    UserController::delete($id);
    return Redirect::route('dashboard');
}
)->name('delete-user');