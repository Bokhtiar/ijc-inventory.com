<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Service;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use PDF;

class BillingController extends Controller
{
    /* list of resource */
    public function index()
    {
        try {
            $billings = Billing::where('status', 0)->latest()->get(['billing_id', 'status', 'date', 'ref', 'telephone', 'email', 'cell_no']);
            return view('admin.billing.index', ['title' => "Billing List", 'billings' => $billings]);
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
        $billingid = Billing::latest()->first();
        $billing = new Billing();
        $billing->ref = Billing::count() == 0 ? "#Inv-"."1" : "#Inv-".$billingid->billing_id + 1;

        $billing->designation =$request->designation;
        $billing->company_name = $request->company_name;
        $billing->company_location = $request->company_location;
        $billing->att = $request->att;
        $billing->date = $request->date;
        $billing->cell_no = $request->cell_no;
        $billing->telephone = $request->telephone;
        $billing->email = $request->email;
        $billing->website = $request->website;
        $billing->bill_creator = $request->bill_creator;
        $billing->biller_designation = $request->biller_designation;
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
        return $pdf->stream('info.pdf', $data, array("Attachment" => false));
        // return $pdf->download($billings->ref.'.pdf');
    }

    /* resource destory */
    public function destroy($id)
    {
        try {
            Billing::find($id)->delete();
            $services = Service::where('billing_id', $id)->get();
            foreach ($services as $item) {
                $item->delete();
            }
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
}
 