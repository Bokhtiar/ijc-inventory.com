<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        try {
            $permissions = Permission::all();
            return view('modules.permission.index', ['title' =>'Permission List', 'permissions' => $permissions]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** Show the form for creating a new resource. */
    public function create()
    {
        try {
            $roles = Role::all();
            return view('modules.permission.create', ['title' => 'Permission Create', 'roles' => $roles]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** Store a newly created resource in storage. */
    public function store(Request $request)
    {
        try {
            $existRole = Permission::where('role_id', $request->role_id)->first();
            if ($existRole) {
                return redirect()->back()->with('info', 'Already permission created, please update');
            }
            Permission::create($request->all());
            return redirect()->route('permission.index')->with('message', "Permission created");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $roles = Role::all();
            $permission = Permission::where('id', $id)->first();
            return view('modules.permission.edit', ['title' => 'Permission List', 'permission' => $permission, 'roles' => $roles]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $permission = Permission::where('id', $id)->first();
            $permission->update($request->all());
            return redirect()->route('permission.index')->with('message', "Permission updated");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    
}
