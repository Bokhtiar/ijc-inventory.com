<?php

namespace App\Exports;

use App\Models\Billing;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportBilling implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    private $start_date;
    private $end_date;
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {  
        // $data = DB::table('users_info')
        // ->whereBetween('pdate', [$this->from_date, $this->to_date])
        if (Auth::user()->role_id == 1) {
            return Billing::whereBetween('date', [$this->start_date, $this->end_date])->get([
                'ref',
                'designation',
                'company_name',
                'company_location',
                'att',
                'date',
                'cell_no',
                'telephone',
                'email',
                'website',
                'less_advance',
                'foreign_company',
                'bill_creator',
                'biller_designation',
            ]);

        }else {

            $billings = Billing::with('createdBy')->where("created_by", Auth::id())->get([
                'ref',
                'designation',
                'company_name',
                'company_location',
                'att',
                'date',
                'cell_no',
                'telephone',
                'email',
                'website',
                'less_advance',
                'foreign_company',
                'bill_creator',
                'biller_designation',
            ]);
            $billings_boss = Billing::with('createdBy')->where("created_by_boss_id", Auth::id())->get([
                'ref',
                'designation',
                'company_name',
                'company_location',
                'att',
                'date',
                'cell_no',
                'telephone',
                'email',
                'website',
                'less_advance',
                'foreign_company',
                'bill_creator',
                'biller_designation',
            ]);

            // Merge collections of objects
            $mergedBillings = $billings->merge($billings_boss);
            //dd($mergedBillings);
            // Filter merged collection based on date range
            return $mergedBillings->whereBetween('date', [$this->start_date, $this->end_date]);

            // Convert the filtered collection to an array
            // $result = $filteredBillings->map(function ($billing) {
            //     return [
            //         'ref' => $billing->ref,
            //         'designation' => $billing->designation,
            //         'company_name' => $billing->company_name,
            //         'company_location' => $billing->company_location,
            //         'att' => $billing->att,
            //         'date' => $billing->date,
            //         'cell_no' => $billing->cell_no,
            //         'telephone' => $billing->telephone,
            //         'email' => $billing->email,
            //         'website' => $billing->website,
            //         'less_advance' => $billing->less_advance,
            //         'foreign_company' => $billing->foreign_company,
            //         'bill_creator' => $billing->bill_creator,
            //         'biller_designation' => $billing->biller_designation,
            //     ];
            // })->toArray();
  
            // return $result;






        }
       
    
        // return User::select('name', 'email')->get(); custome 
    }

    public function headings(): array
    {
        return [
            'ref',
            'designation',
            'company_name',
            'company_location',
            'att',
            'date',
            'cell_no',
            'telephone',
            'email',
            'website',
            'less_advance',
            'foreign_company',
            'bill_creator',
            'biller_designation',
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
