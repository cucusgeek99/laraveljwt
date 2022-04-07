<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

Class Userinfo  extends Controller
{

    public function AuthUserInfo(){

    $user = auth()->user();
    $userinfo;
    $userinfo['name']=$user->name;
    $userinfo['email']=$user->email;
    return $userinfo;
    }
    

}