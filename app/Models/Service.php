<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model 
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'description_service',
        'govt_fees',
        'others_expenses',
        'professional_fees',
        'tax',
        'vat',
        'grand_total'
    ];
}
