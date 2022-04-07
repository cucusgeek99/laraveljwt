<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Annonce extends Model
{
    use HasFactory;
    protected $primaryKey = 'idAn';
   // protected $foreignKey ='iduser';

    protected $fillable = [
   'idUser',
    'anNumber',
    'dollarPrice',
    'quantMin',
    'quantMax',
    'paymentMethodId',
    'status',
    'cryptoId',
    'cryptoPrice'
];
  public function user()
    {
        return $this->belongsTo(User::class,'idUser','id');
    }
    public function crypto()
    {
        return $this->belongsTo(Crypto::class,'cryptoId','idCrypto');
    }
    
}