<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
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
        return "you're lost";
    }
   
})->name('dashboard');
