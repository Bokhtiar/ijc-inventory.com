<?php

namespace App\Exports;

use App\Models\Billing;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportReportBilling implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $start_date;
    private $end_date;
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function collection()
    {
        return Billing::query()
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->select(
                'billings.ref',
                'billings.designation',
                'billings.company_name',
                'billings.company_location',
                'billings.att',
                'billings.date',
                'billings.cell_no',
                'billings.telephone',
                'users.email',
                'billings.website',
                'billings.less_advance',
                'billings.foreign_company',
                'billings.bill_creator',
                'billings.biller_designation',
            )
            ->join('users', 'users.id', '=', 'billings.user_id')
            ->get();
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
