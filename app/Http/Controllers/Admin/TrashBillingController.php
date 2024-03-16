<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;

class TrashBillingController extends Controller
{
    /* trash_list */
    public function index()
    {
        try {
            $billings = Billing::where('trash', 1)->latest()->get(['billing_id', 'date', 'ref', 'telephone', 'email', 'cell_no']);
            return view('admin.billing.index', ['title' => "Billing List", 'billings' => $billings]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
