<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'iduser',
        'name',
        'email',
        'email_verified_at',
        'password',
        'photo',
        'role',
        'provider',
        'provider_id',
        'status',
        'remember_token',
        'created_at',
        'updated_at'
        
    ];
    use HasFactory;
}
