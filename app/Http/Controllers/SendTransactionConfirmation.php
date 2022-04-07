<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Confirmation;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class SendTransactionConfirmation extends Controller
{
    public function SendEmailConfirmation()
    {

    }
}
