<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'company_id',
        'issue_type',
        'type',
        'status',
        'summary',
        'priority',
        'due_date',
        'assign',
        'start_date',
        'created_by',
        'created_by_boss_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
}
