<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /* Create a new controller instance. */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* Show the application dashboard. */
    public function index()
    {
        return redirect()->route('dashboard');   
    }

    public function dashboard()
    {
        if (Auth::user()->role_id == 4) {
            return redirect()->route('profile.edit', Auth::id());
        }else{
            return redirect()->route('dashboard');
        }
    }
}
