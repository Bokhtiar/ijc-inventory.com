<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Billing;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Exports\ExportBilling;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BillingController extends Controller
{
    /* list of resource */
    public function index()
    {
        try {
            if (Auth::user()->role_id == 1) {
                $billings = Billing::with('createdBy')->latest()->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'email', 'created_by', 'cell_no', 'company_name']);
                return view('admin.billing.index', ['title' => "Billing List", 'billings' => $billings]);
            }else {
                $billings = [];
                $billings = Billing::with('createdBy')->where("created_by", Auth::id())->get();
                $billings_boss = Billing::with('createdBy')->where("created_by_boss_id", Auth::id())->get();

                // Merge collections of objects
                $mergedBillings = $billings->merge($billings_boss);
                return view('admin.billing.index', ['title' => "Billing List", 'billings' => $mergedBillings]);
            }
           
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function trash_list()
    {
        try {
            $billings = Billing::where('status', 1)->latest()->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'email', 'cell_no']);
            return view('admin.billing.trash', ['title' => "Billing List", 'billings' => $billings]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


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
        if (!$request->description_service) {
            return redirect()->back()->with('info', 'Service are not avaialble.');
        }

        $today = Carbon::now();
        $currentYear = $today->year;
        $lastTowDigit = str_split($currentYear);

        $billingid = Billing::latest()->first();
        $billing = new Billing();
        $billing->ref = Billing::count() == 0 ? "IJC" . "/" . $lastTowDigit[2] . '' . $lastTowDigit[3] . "/Inv-" . 1 : "IJC" . "/" . $lastTowDigit[2] . '' . $lastTowDigit[3] . "/Inv-" . Billing::count() + 1;

        $billing->designation = $request->designation;
        $billing->company_name = $request->company_name;
        $billing->company_location = $request->company_location;
        $billing->att = $request->att;
        $billing->date = $request->date;
        $billing->cell_no = $request->cell_no;
        $billing->less_advance = $request->less_advance;
        $billing->foreign_company = $request->foreign_company;
        $billing->telephone = $request->telephone;
        $billing->email = $request->email;
        $billing->website = $request->website;
        $billing->bill_creator = $request->bill_creator;
        $billing->biller_designation = $request->biller_designation;
        $billing->note= $request->note;

        $billing->created_by = Auth::id();
        $user = User::find(Auth::id());
        $billing->created_by_boss_id = $user->created_by ? $user->created_by : 1;

        $billing->save();

        $description_service = $request->description_service;
        $govt_fees = $request->govt_fees;
        $others_expenses = $request->others_expenses;
        $professional_fees = $request->professional_fees;
        $tax = $request->tax;
        $vat = $request->vat;

        for ($count = 0; $count < count($description_service); $count++) {
            $data = array(
                'billing_id' => $billing->billing_id,
                'description_service' => $description_service[$count],
                'govt_fees'  => $govt_fees[$count],
                'others_expenses'  => $others_expenses[$count],
                'professional_fees'  => $professional_fees[$count],
                'tax'  => $tax[$count],
                'vat'  => $vat[$count],
                'grand_total'  => $govt_fees[$count] + $others_expenses[$count] + $professional_fees[$count] + $tax[$count]  + $vat[$count],
            );
            $insert_data[] = $data;
        }

        Service::insert($insert_data);

        // $billings = Billing::find($billing->billing_id);
        // $services = Service::where('billing_id', $billing->billing_id)->get();

        // $data = [
        //     'billings' => $billings,
        //     'services' => $services
        // ];


        //     $pdf = PDF::loadView('admin\billing\pdf', $data);

        //    return $pdf->download('itsolutionstuff.pdf');

        // return $pdf->stream('info.pdf', array("Attachment" => false));

        return redirect()->route('admin.billing.list')->with('message', 'Billing Successfully Done.');
    }

    /* specific resoruce show */
    public function show($id)
    {
        try {
            $billings = Billing::find($id);
            $services = Service::where('billing_id', $id)->get();

            $data = [
                'billings' => $billings,
                'services' => $services
            ];

            return view('admin.billing.show', ['title' => "Billing Show", 'billings' => $billings, 'services' => $services]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // edit billing
    public function edit($id)
    {
        $edit = Billing::find($id);
        $services = Service::where('billing_id', $id)->get();
        $title = "Billing edit";
        return view('admin.billing.edit', compact('edit', 'services', 'title'));
    }

    // edit billing
    public function restore($id)
    {
        $edit = Billing::find($id);
        $services = Service::where('billing_id', $id)->get();
        $title = "Create New Billing";
        return view('admin.billing.restore', compact('edit', 'services', 'title'));
    }

    

    // bill has assing for edit page
    public function bllling_ways_service($id)
    {
        $services =  Service::where('billing_id', $id)->get();
        return response()->json([
            'services' => $services,
        ]);
    }

    /** update */
    public function update(Request $request, $id)
    {
        // billing exist data delete
        $services = Service::where('billing_id', $id)->get();
        foreach ($services as $key => $item) {
            Service::find($item->service_id)->delete();
        }

        $billing = Billing::find($id);
        $billing->ref = $billing->ref;
        $billing->designation = $request->designation;
        $billing->company_name = $request->company_name;
        $billing->company_location = $request->company_location;
        $billing->att = $request->att;
        $billing->date = $request->date;
        $billing->cell_no = $request->cell_no;
        $billing->less_advance = $request->less_advance;
        $billing->foreign_company = $request->foreign_company;
        $billing->telephone = $request->telephone;
        $billing->email = $request->email;
        $billing->website = $request->website;
        $billing->bill_creator = $request->bill_creator;
        $billing->biller_designation = $request->biller_designation;
        $billing->note = $request->note;


        $billing->created_by = Auth::id();
        $user = User::find(Auth::id());
        $billing->created_by_boss_id = $user->created_by ? $user->created_by : 1;

        
        $billing->save();

        /** daynamic form */
        $description_service = $request->description_service;
        $govt_fees = $request->govt_fees;
        $others_expenses = $request->others_expenses;
        $professional_fees = $request->professional_fees;
        $tax = $request->tax;
        $vat = $request->vat;

        if ($description_service !== null) {


            for ($count = 0; $count < count($description_service); $count++) {
                $data = array(
                    'billing_id' => $billing->billing_id,
                    'description_service' => $description_service[$count],
                    'govt_fees'  => $govt_fees[$count],
                    'others_expenses'  => $others_expenses[$count],
                    'professional_fees'  => $professional_fees[$count],
                    'tax'  => $tax[$count],
                    'vat'  => $vat[$count],
                    'grand_total'  => $govt_fees[$count] + $others_expenses[$count] + $professional_fees[$count] + $tax[$count]  + $vat[$count],
                );
                $insert_data[] = $data;
            }
            Service::insert($insert_data);
        }
        return redirect()->route('admin.billing.list')->with('message', 'Billing Update Successfully Done.');
    }


    /* download pdf */
    public function pdfDownload($id)
    {

        $billings = Billing::find($id);
        $services = Service::where('billing_id', $id)->get();

        $data = [
            'billings' => $billings,
            'services' => $services
        ];

        $pdf = PDF::loadView('admin.billing.pdf', $data);

        //return $pdf->stream('info.pdf', $data, array("Attachment" => false));

        return $pdf->download($billings->ref.'.pdf');
    }


    /* resource destory */
    public function destroy($id)
    {

        try {
            Billing::find($id)->delete();
            // Billing::find($id)->delete();
            // $services = Service::where('billing_id', $id)->get();
            // foreach ($services as $item) {
            //     $item->delete();
            // }
            return redirect()->back()->with('success', "Deleted Successfully Done.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* trash */
    public function status($id)
    {
        try {
            $bill = Billing::find($id);

            if ($bill->status == 0) {
                $bill->status = 1;
                $bill->save();
            }
            return back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* print */
    public function print($id)
    {
        try {
            $billings = Billing::find($id);
            $services = Service::where('billing_id', $id)->get();

            $data = [
                'billings' => $billings,
                'services' => $services
            ];
            // return view('admin.billing.print', $data);
            $pdf = PDF::loadView('admin.billing.pdf', $data);
            return $pdf->stream('info.pdf', $data, array("Attachment" => false));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** export bill */
    public function exportBills(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        return Excel::download(new ExportBilling($start_date, $end_date), $start_date . '-to-' . $end_date . '.xlsx');
    }


    public function softDeleteData()
    {
        $billings = Billing::onlyTrashed()->get();
        return view('admin.billing.softDeleteData', ['title' => 'Restore List', 'billings' => $billings]);
    }

    public function softDeleteDataShow($id)
    {
        try {
            $billings = Billing::withTrashed()->find($id);
            $services = Service::where('billing_id', $id)->get();
            return view('admin.billing.show', ['title' => "Billing Show", 'billings' => $billings, 'services' => $services]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function softDataRestore($id)
    {
        Billing::withTrashed()->find($id)->restore();
        $billings = Billing::onlyTrashed()->get();
        return view('admin.billing.softDeleteData', ['title' => 'Restore List', 'billings' => $billings]);
    }
}
