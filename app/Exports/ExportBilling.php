<?php

namespace App\Exports;

use App\Models\Billing;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBilling implements FromCollection
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
        return Billing::whereBetween('date', [$this->start_date, $this->end_date])->get();
        // return User::select('name', 'email')->get(); custome 
    }
}
