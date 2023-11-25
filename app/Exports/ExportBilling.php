<?php

namespace App\Exports;

use App\Models\Billing;
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
