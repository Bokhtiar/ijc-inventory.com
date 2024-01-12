<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        try {
            $employee = User::latest()->where('role_id', 3)->get();
            return view('modules.employee.index', ['title'=> 'Employee List', 'employees' => $employee]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**Show the form for creating a new resource. */
    public function create()
    {
        try {
            $roles = Role::where('id', '!=', 4)->get();
            return view('modules.employee.createUpdate', ['title' => 'Employee Create', 'roles' => $roles]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /* store resoruce documents */
    public static function storeDocument($request, $image = null, $password = null)
    {
        if ($request->hasFile('profile_pic')) {
            $path = 'images/user/';
            $db_field_name = 'profile_pic';
            $uploadImage =  ImageUpload::Image($request, $path, $db_field_name);
        }else{
            $uploadImage = $image;   
        }

        return array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password ? $request->password : $password,
            'designation' => $request->designation,
            'profile_pic' => @$uploadImage,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'join_date' => $request->join_date,
            'address' => $request->address,
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|numeric|unique:users,phone',
            ]);

            if ($validator->fails()) {
                return redirect()->route('employee.create')
                ->withErrors($validator)
                ->withInput();
            }

            User::create($this->storeDocument($request));
            return redirect()->route('employee.index')->with('message', 'Employee Created Successfully Done');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $show = User::find($id);
            return view('modules.employee.show', ['title' => "Emloyee Details", 'show' => $show]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $roles = Role::where('id', '!=', 4)->get();
            $edit = User::find($id);
            return view('modules.employee.createUpdate', ['title' => 'Employee edit', 'edit' => $edit, 'roles' => $roles]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $update = User::find($id);
            $update->update($this->storeDocument($request, $update->profile_pic, $update->password));
            return redirect()->route('employee.index')->with('message', 'Employee update Successfully Done');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       try {
            User::find($id)->delete();
            return redirect()->back()->with('info', 'Employee Deleted Successfully');
       } catch (\Throwable $th) {
        throw $th;
       }
    }
}
