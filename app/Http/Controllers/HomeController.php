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
        if (Auth::user()->role_id == 1) {
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('user.dashboard');
        }
    }
}
