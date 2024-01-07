<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /* store resoruce documents */
    public static function storeDocument($request, $image = null)
    {
        if ($request->hasFile('profile_pic')) {
            $path = 'images/user/';
            $db_field_name = 'profile_pic';
            $uploadImage =  ImageUpload::Image($request, $path, $db_field_name);
        } else {
            $uploadImage = $image;
        }

        return array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => 3,
            'designation' => $request->designation,
            'profile_pic' => @$uploadImage,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'join_date' => $request->join_date,
            'address' => $request->address,
        );
    }

    /** resource update */
    public function update(Request $request, $id)
    {
        try {
            $update = User::find($id);
            $update->update($this->storeDocument($request, $update->profile_pic));
            return redirect()->back()->with('message', 'Update Successfully Done...!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** edit */
    public function profile_edit()
    {
        $edit = Auth::user();
        return view('modules.profile.edit', ['title' => "Profile Edit", 'edit' => $edit]);
    }

    /** password change */
    public function password_change(Request $request)
    {
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
                return redirect()->back()->with('info', "Your old password & new password same.");;
            }
        } else {
            return redirect()->back()->with('error', "Something went wrong.");;
        }
    }

    /** forgot password */
}
