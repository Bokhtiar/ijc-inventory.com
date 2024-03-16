<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /* The attributes that are mass assignable. */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'role_id',
        'password',
        'password_text',
        'created_by',
        'is_admin',
        'deleted_at'
    ];

    /* The attributes that should be hidden for serialization. */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* The attributes that should be cast. */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /* role reletion user tables */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
