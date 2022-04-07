<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    protected $primaryKey = 'id';

    protected $fillable=['paymentMethodName'];
    use HasFactory;
}
