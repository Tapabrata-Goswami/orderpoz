<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'status',
        'role_id',
        'name',
        'email',
        'module_access',
        'email_verified_at',
        'password',
        'remember_token',
        'image',
    ];
}
