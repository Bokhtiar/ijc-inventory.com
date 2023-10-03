<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /* create page  */
    public function create()
    {
        try {
            return view('admin.billing.create', ['title' => "Billing create"]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* store resource */
    public function store(Request $request)
    {
        dd($request->all());
    }
}
