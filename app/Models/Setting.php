<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'company_name',
        'location',
        'phone',
        'work_time',
        'logo',
    ];
}
