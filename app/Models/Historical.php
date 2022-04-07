<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historical extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable=['userId,type,cryptoId,quantity,validated,created_at,updated_at'];

}
