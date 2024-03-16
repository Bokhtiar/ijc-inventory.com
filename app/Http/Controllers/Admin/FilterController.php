<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use PDF;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /** filter page */
    public function index()
    {

        $billings = Billing::latest()->whereDate('created_at', today())->get();
        return view('admin.filter.index', ['title' => "Today Bill", 'billings' => $billings,]);
    }

    public function companyfilter(Request $request)
    {

        $searchTerm = $request->company_name;

        $billings = Billing::latest()->where(function ($query) use ($searchTerm) {
            $searchTerms = explode(',', $searchTerm);
            foreach ($searchTerms as $term) {
                $query->where('company_name', 'like', '%' . trim($term) . '%');
            }
        })
            ->get();
       
        return view('admin.filter.index', ['title' => $searchTerm . " Bill Filter", 'billings' => $billings, 'company_name' => $searchTerm]);
    }

    /** betweenDate */
    public function betweenDate(Request $request)
    {
        
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $billings = Billing::whereBetween('date', [$request->start_date, $request->end_date])->get();
        return view('admin.filter.index', ['title' => $request->start_date . " To " . $request->end_date . " Bill Date Filter", 'billings' => $billings, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    /** download company ways */
    public function donwloadCompnayWays(Request $request)
    {
       
        $searchTerm = $request->company_name;
        if (!$searchTerm) {
            return redirect()->back()->with('info', "Must be need select company");
        }
        $billings = Billing::where(function ($query) use ($searchTerm) {
            $searchTerms = explode(',', $searchTerm);
            foreach ($searchTerms as $term) {
                $query->where('company_name', 'like', '%' . trim($term) . '%');
            }
        })
        ->get();

        $data = [
            'billings' => $billings,
            'company_name' => $searchTerm,
        ];
        //dd($data['billings']);

        // $pdf = PDF::loadView('admin.filter.download', $data);
        // return $pdf->stream('info.pdf', $data, array("Attachment" => false));
        $pdf = PDF::loadView('admin.filter.download', $data);

        return $pdf->stream('info.pdf', $data, array("Attachment" => false));

        //return $pdf->download($searchTerm.'.pdf');
    }
}
