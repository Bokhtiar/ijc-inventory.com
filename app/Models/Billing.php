<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Billing extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
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
        'less_advance',
        'foreign_company',
        'bill_creator',
        'biller_designation',
        'note',
        
        'created_by',
        'created_by_boss_id'
    ];



    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public static function service_amount($id)
    {
        return Service::where('billing_id', $id)->sum('grand_total');
    }

}



