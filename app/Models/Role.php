<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
