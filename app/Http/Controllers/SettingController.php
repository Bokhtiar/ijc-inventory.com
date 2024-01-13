<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource. */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Setting::find($id);
        return view('modules.setting.edit', ['title' => 'Setting Update', 'edit' => $edit]);
    }

    /* store resoruce documents */
    public static function storeDocument($request, $image = null,)
    {
        if ($request->hasFile('logo')) {
            $path = 'images/user/';
            $db_field_name = 'logo';
            $uploadImage =  ImageUpload::Image($request, $path, $db_field_name);
        } else {
            $uploadImage = $image;
        }

        return array(
            'company_name' => $request->company_name,
            'location' => $request->location,
            'phone' => $request->phone,
            'work_time' => $request->work_time,
            'company_name' => $request->company_name,
            'logo' => @$uploadImage,
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $update = Setting::find($id);
            $update->update($this->storeDocument($request, $update->logo));
            return redirect()->back()->with('message', 'Update Successfully Done');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
