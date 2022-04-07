<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{ 
    protected $primaryKey = 'idcrypto';

    protected $fillable=['cryptoName','cryptoSigle','cryptoAddress','cryptoImage','status'];
    use HasFactory;

    
}
