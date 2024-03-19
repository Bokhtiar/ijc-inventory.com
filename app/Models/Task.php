<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'company_id',
        'issue_type',
        'type',
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

    public function assign()
    {
        return $this->belongsTo(User::class, 'assign');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function created_by_boss_id()
    {
        return $this->belongsTo(User::class, 'created_by_boss_id');
    }
}
