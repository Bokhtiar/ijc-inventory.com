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
            $billings = Billing::latest()->get(['billing_id', 'date', 'ref', 'telephone', 'email', 'cell_no']);
            return view('admin.billing.index', ['title' => "Billing List", 'billings' => $billings]);
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
        $billing->company_name_location = $request->company_name_location;
        $billing->att = $request->att;
        $billing->date = $request->date;
        $billing->cell_no = $request->cell_no;
        $billing->telephone = $request->telephone;
        $billing->email = $request->email;
        $billing->website = $request->website;

        $billing->account_name_1 = $request->account_name_1;
        $billing->account_number_1 = $request->account_number_1;
        $billing->account_routing_no_1 = $request->account_routing_no_1;
        $billing->bank_name_1 = $request->bank_name_1;
        $billing->swift_code_1 = $request->swift_code_1;
        $billing->branch_name_1 = $request->branch_name_1;

        $billing->account_name_2 = $request->account_name_2;
        $billing->account_number_2 = $request->account_number_2;
        $billing->account_routing_no_2 = $request->account_routing_no_2;
        $billing->bank_name_2 = $request->bank_name_2;
        $billing->branch_name_2 = $request->branch_name_2;
        $billing->swift_code_2 = $request->swift_code_2;

        $billing->bill_creator = $request->bill_creator;
        $billing->biller_designation = $request->biller_designation;
        $billing->save();


        $description_service = $request->description_service;
        $govt_fees = $request->govt_fees;
        $others_expenses = $request->others_expenses;
        $professional_fees = $request->professional_fees;
        $tax = $request->tax;
        $vat = $request->vat;
        $grand_total = $request->grand_total;


        for ($count = 0; $count < count($description_service); $count++) {
            $data = array(
                'billing_id' => $billing->billing_id,
                'description_service' => $description_service[$count],
                'govt_fees'  => $govt_fees[$count],
                'others_expenses'  => $others_expenses[$count],
                'professional_fees'  => $professional_fees[$count],
                'tax'  => $tax[$count],
                'vat'  => $vat[$count],
                'grand_total'  => $grand_total[$count],

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
        //return $pdf->stream('info.pdf', $data, array("Attachment" => false));
        return $pdf->download($billings->ref.'.pdf');
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
 