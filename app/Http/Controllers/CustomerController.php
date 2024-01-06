<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        try {
            $customer = User::latest()->where('role_id', 4)->get();
            return view('modules.customer.index', ['title' => 'Customer List', 'customers' => $customer]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**Show the form for creating a new resource. */
    public function create()
    {
        try {
            return view('modules.customer.createUpdate', ['title' => 'Customer Create']);
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
        } else {
            $uploadImage = $image;
        }

        return array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => 4,
            'password' => $request->password ? $request->password : $password,
            'designation' => $request->designation,
            'profile_pic' => @$uploadImage,
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
            User::create($this->storeDocument($request));
            return redirect()->route('customer.index')->with('message', 'Customer Created Successfully Done');
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
            return view('modules.customer.show', ['title' => "Customer Details", 'show' => $show]);
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
            $edit = User::find($id);
            return view('modules.customer.createUpdate', ['title' => 'Customer edit', 'edit' => $edit]);
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
            return redirect()->route('customer.index')->with('message', 'Customer update Successfully Done');
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
            return redirect()->back()->with('info', 'Customer Deleted Successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
