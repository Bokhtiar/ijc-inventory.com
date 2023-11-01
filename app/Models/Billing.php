<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    
    protected $table = 'billings';
    protected $primaryKey = 'billing_id';

    protected $fillable = [
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

        'account_name_1',
        'account_number_1',
        'account_routing_no_1',
        'bank_name_1',
        'swift_code_1',
        'branch_name_1',

        'account_name_2',
        'account_number_2',
        'account_routing_no_2',
        'bank_name_2',
        'swift_code_2',
        'branch_name_2',

        'bill_creator',
        'biller_designation',
    ];
}
