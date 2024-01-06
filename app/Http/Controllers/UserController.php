<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;

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
}
