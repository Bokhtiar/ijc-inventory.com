<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * report list.
     */
    public function report($type)
    {
        if ($type == 'today') {
            $billings = Billing::latest()->whereDate('date', Carbon::today())->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        }else if ($type == 'week'){
            $billings = Billing::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        }else if ($type == 'month') {
            $billings = Billing::latest()->whereMonth('date', Carbon::now()->month)->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        }else if ($type == 'year'){
            $billings = Billing::latest()->whereYear('created_at', Carbon::now()->year)->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        }else if ($type == 'filter'){
            $billings = Billing::latest()->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        }
        return view('modules.report.index', ['title' => "Billing List", 'billings' => $billings, 'type' => $type]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
