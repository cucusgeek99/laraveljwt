<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $primaryKey = 'idwallet';

    protected $fillable= ['idUser','amount','cryptoId','lastUserAdress'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class,'idUser','id');
    }
    public function crypto()
    {
        return $this->belongsTo(Crypto::class,'cryptoId','idCrypto');
    }
}
