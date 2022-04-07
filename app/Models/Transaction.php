<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'idtransac';

    protected $fillable=['amount','annonceId','senderId','receiverId','status','created_at','end_at'];
    use HasFactory;
}
