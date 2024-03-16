<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /* display of desboard */
    public function index()
    {
        try {
            return view('admin.dashboard', ['title' => "Dashboard"]);
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
