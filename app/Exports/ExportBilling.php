<?php

namespace App\Exports;

use App\Models\Billing;
use Carbon\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportBilling implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    private $start_date;
    private $end_date;
    private $type;

    public function __construct($start_date, $end_date, $type)
    {
        $this->type = $type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->type == 'today') {       
            return Billing::whereDate('date', Carbon::today())->select(
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
            
        } else if ($this->type == 'week') {
            return  Billing::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->select(
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
        } else if ($this->type == 'month') {
            return  Billing::whereMonth('date', Carbon::now()->month)->select(
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
        } else if ($this->type == 'year') {
            return  Billing::whereYear('date', Carbon::now()->year)->select(
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
        } else if ($this->type == 'filter') {
            return  Billing::query()
                ->whereBetween('date', [$this->start_date, $this->end_date])->select(
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
