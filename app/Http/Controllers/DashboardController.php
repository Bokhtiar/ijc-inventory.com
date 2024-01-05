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

    /** edit */
    public function profile_edit() 
    {
        $edit = Auth::user();
        return view('modules.profile.edit', ['title' => "Profile Edit", 'edit' => $edit]);
    }

    /** password change */
    public function password_change(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedpassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedpassword)) {
            if (!Hash::check($request->password, $hashedpassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->route('login')->with('message', "Password change Successfully Done.");;
            } else {
                return redirect()->back()->with('info', "Already exist this password.");;
            }
        } else {
            return redirect()->back()->with('error', "Something went wrong.");;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
