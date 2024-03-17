<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompnayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->get();
        return view('admin.company.index', ['title' => "Company List", 'companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.createUpdate', ['title' => "Company create"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->save();
        return redirect()->route('admin.company.index')->with('success', "Company create successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Company::find($id);
        return view('admin.company.createUpdate', ['title' => "Compnay edit", 'edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Company::find($id);
        $company->name = $request->name;
        $company->save();
        return redirect()->route('admin.company.index')->with('success', "Company update successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Company::find($id)->delete();
        return redirect()->route('admin.company.index')->with('success', "Company delete successfully.");
    }
}
