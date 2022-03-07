<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('login', [AuthController::class, 'index'])->name('login-api');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('/tasks/{user_id}', 
function ($user_id) {    
    return TaskController::getByUserId($user_id);    
}
)->name('api-tasks');
Route::post('/tasks', 
function (Request $request) {    
    return TaskController::store($request);  
}
)->name('api-tasks-create');

Route::put('/update-task', 
function (Request $request){    
    return TaskController::update($request);
}
)->name('update-task');

Route::delete('/delete-task', 
function (Request $request){    
    return TaskController::delete($request->id);
}
)->name('delete-task');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
