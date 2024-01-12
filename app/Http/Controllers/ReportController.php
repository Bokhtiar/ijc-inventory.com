<?php

namespace App\Http\Controllers;

use App\Exports\ExportBilling;
use App\Models\Billing;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /** report list.*/
    public function report(Request $request, $type)
    {
        if ($type == 'today') {
            $billings = Billing::whereDate('date', Carbon::today())->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        } else if ($type == 'week') {
            $billings = Billing::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        } else if ($type == 'month') {
            $billings = Billing::whereMonth('date', Carbon::now()->month)->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        } else if ($type == 'year') {
            $billings = Billing::whereYear('date', Carbon::now()->year)->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        } else if ($type == 'filter') {
            $billings = Billing::whereDate('date', Carbon::today())->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        }
        return view('modules.report.index', ['title' => "Billing List", 'billings' => $billings, 'type' => $type]);
    }

    /** resoruce download */
    public function reportDownload($type)
    {
        $filename = str_replace(['/', '\\'], '_', $type . '.xlsx');
        $formattedStartDate = null;
        $formattedEndDate = null;
        return Excel::download(new ExportBilling($formattedStartDate, $formattedEndDate, $type), $filename);
    }

    /** fiter report */
    public function reportFilter(Request $request)
    {
        $type = 'filter';
        $data = [
            "daterange" => $request->daterange
        ];
        $dateRange = explode(" - ", $data['daterange']);
        $start_date = trim($dateRange[0]);
        $end_date = trim($dateRange[1]);

        $carbonStartDate = Carbon::createFromFormat('m/d/Y', $start_date);
        $formattedStartDate = $carbonStartDate->format("Y-m-d");

        $carbonEndDate = Carbon::createFromFormat('m/d/Y', $end_date);
        $formattedEndDate = $carbonEndDate->format("Y-m-d");

        $billings = Billing::whereBetween('date', [$formattedStartDate, $formattedEndDate])->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'user_id', 'cell_no']);
        return view('modules.report.index', [
            'title' => "Billing List",
            'billings' => $billings,
            'type' => $type,
            'start_date' => $formattedStartDate,
            'end_date' => $formattedEndDate,
            'daterange' => $request->daterange
        ]);
    }

    public function reportFilterDownload($start_date, $end_date)
    {
        $type = 'filter';
        $filename = $start_date . '-to-' . $end_date;
        $filename = str_replace(['/', '\\'], '_', $filename . '.xlsx');
        return Excel::download(new ExportBilling($start_date, $end_date, $type), $filename);
    }
}
