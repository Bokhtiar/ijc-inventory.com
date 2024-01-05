<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /** resource list */
    public function index()
    {
        try {
            $roles = Role::all();
            return view('modules.role.index', ['title' => 'Role List', 'roles' => $roles ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** store resoruce */
    public function store(Request $request)
    {
        try {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            return redirect()->back()->with('message', 'Role Created successfully done.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** edit resoruce */
    public function edit($id)
    {
        try {
            $roles = Role::all();
            $edit = Role::find($id);
            return view('modules.role.index', [ 'title' => 'Role Title','roles' => $roles, 'edit' => $edit]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** update resource */
    public function update(Request $request, $id)
    {
        try {
            $update = Role::find($id);
            $update->name = $request->name;
            $update->save();
            return redirect()->route('role.index')->with('message', 'Role updated successfully done');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
