<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Http\Request;
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
    //UserController::index();
    if(Auth::user()->hasRole('admin')){
        $users = User::all();
        return View::make('dashboard')
        ->with( 'users', $users );//view('dashboard');
    }else{
        //return "you're lost";
         return Redirect::route('tasks', Auth::user()->id);
    }
   
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/tasks/{user_id}', 
function ($user_id) {
    if(Auth::user()->hasRole('admin') || Auth::user()->id==$user_id){
        return TaskController::getByUserId($user_id);
    }else{
        abort(404);      
         //Redirect::route('tasks', Auth::user()->id);
    }
    
}
)->name('tasks');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-tasks', 
function () {
    return View::make('tasks\add-task');
}
)->name('add-tasks');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-task/{id}', 
function ($id) {
    return TaskController::edit($id);
}
)->name('edit-task');

Route::middleware(['auth:sanctum', 'verified'])->post('/add-tasks', 
function (Request $request){
    return TaskController::store($request);
}
)->name('add-tasks');

Route::middleware(['auth:sanctum', 'verified'])->put('/update-task/{id}', 
function ($id, Request $request){
    $request->id = $id;
    return TaskController::update($request);
}
)->name('update-task');

Route::middleware(['auth:sanctum', 'verified'])->get('/delete-task/{id}', 
function ($id){
    return TaskController::trash($id);
}
)->name('trash-task');

Route::middleware(['auth:sanctum', 'verified'])->delete('/delete-task/{id}', 
function ($id){    
    return TaskController::delete($id);
}
)->name('delete-task');