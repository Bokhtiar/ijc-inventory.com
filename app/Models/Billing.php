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
        'user_id',
        'website',
        'less_advance',
        'foreign_company',
        'bill_creator',
        'biller_designation',
    
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
