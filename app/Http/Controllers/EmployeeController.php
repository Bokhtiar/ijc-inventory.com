<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        try {
            $employee = User::where('role_id', 3)->get();
            return view('modules.employee.index', ['title'=> 'Employee List', 'employees' => $employee]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**Show the form for creating a new resource. */
    public function create()
    {
        try {
            return view('modules.employee.createUpdate', ['title' => 'Employee Create']);
        } catch (\Throwable $th) {
            throw $th;
        }
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
