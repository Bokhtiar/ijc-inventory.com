<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /** list of resoruce */
    public function index()
    {
        $employees = User::latest()->where('created_by', Auth::id())->get();
        return view('admin.employee.index', ['title' => "Employee List", 'employees' => $employees]);
    }
    /** store resoruce */
    public function create()
    {
        return view('admin.employee.create', ['title' => "Create Employee"]);
    }

    /** store */
    public function store(Request $request)
    {
     
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $findUser = User::find(Auth::id());
        
        $user->created_by = $findUser->id;
        if ($findUser->role_id == 1) { //when super admin create employee create admin
            $user->role_id = 2;
        } else if ($findUser->role_id == 2) { //when admin create employee add employee
            $user->role_id = 3;
        }

        $user->password_text = $request->password;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.employee.list')->with('success', 'Employee Created.');
    }

    /** show */
    public function show($id)
    {
        // $billings = [];
        // $show = User::find($id);
        // $billings = Billing::where("created_by", $id)->get();
        // $billings_boss = Billing::where("created_by_boss_id", $id)->get();
        // $billings.push($billings, $billings_boss);
        $billings = [];
        $show = User::find($id);
        $billings = Billing::with('createdBy')->where("created_by", $id)->get();
        $billings_boss = Billing::with('createdBy')->where("created_by_boss_id", $id)->get();

        // Merge collections of objects
        $mergedBillings = $billings->merge($billings_boss);

  
        return view('admin.employee.billing.index', ['title' => $show->name . " Created bill", 'show' => $show, 'billings' => $mergedBillings]);
    }

    /** edit */
    public function edit($id)
    {
        $edit = User::find($id);
        return view('admin.employee.create', ['title' => "Update Employee", 'edit' => $edit]);
    }

    /** update */
    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        

        $findUser = User::find(Auth::id());

        $user->created_by = $findUser->id;
        if ($findUser->role_id == 1) { //when super admin create employee create admin
            $user->role_id = 2;
        } else if ($findUser->role_id == 2) { //when admin create employee add employee
            $user->role_id = 3;
        }

        $user->password_text = $request->password;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.employee.list')->with('success', 'Employee Updated.');
    }

    /** destory */
    public function destroy($id)
    {

        try {
            User::find($id)->delete();
            return redirect()->back()->with('success', "Account Deactive Successfully Done.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function softDeleteList()
    {
        $employees = User::onlyTrashed()->get();
        return view('admin.employee.restore', ['title' => "Restore Employee List", 'employees' => $employees]);
    }

    public function softDataRestore($id)
    {
        User::withTrashed()->find($id)->restore();
        $employees = User::onlyTrashed()->get();
        return view('admin.employee.restore', ['title' => 'Restore Employee List', 'employees' => $employees]);
    }
}
