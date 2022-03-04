<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public static function index()
    {
        $users = User::all();
        
        return view('dashboard')
        /* ->with( 'users', $users) */;
    }
}
