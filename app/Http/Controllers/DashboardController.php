<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /* display of desboard */
    public function index()
    {
        try {
            return view('dashboard', ['title' => "Dashboard"]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /*logout
    ............................
    |auth
    ............................
    admin auth user logout 
    */



    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
