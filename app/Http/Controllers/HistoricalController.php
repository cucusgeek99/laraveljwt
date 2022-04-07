<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoricalController extends Controller
{
    public function MakeCryptoDeposit(Request $request)
    {
        $this->validate($request, [            
            'amount'=> 'required',
            'cryptoId'=> 'required',
            // 'senderId'=> 'required',
           // 'receiverId'=> 'required',
            // 'created_at'=> 'required',
            // 'end_at'=> 'required'

           
        ]);
        
        $currentuser=Auth::user();
        $currentid=Auth::user()->id;
         if(DB::table('wallets')
          ->where('idUser',$currentid)
          ->where('cryptoId',$request->cryptoId)
          ->doesntExist()

        )
        {
            DB::table('wallets')->insert([
                'idUser' => $currentid,
                'amount'=> $request->amount,
               'cryptoId'=> $request->cryptoId,
            ]);

            DB::table('wallets')
            ->where('idUser',$currentid)
            ->where('cryptoId',$request->cryptoId)
            ->update(['amount' => $request->amount]);

         

        }
        // protected $fillable=['userId,type,cryptoId,quantity,validated,created_at,updated_at'];

        DB::table('historical')->insert([
            ['userId'=>$currentid,'type'=>1,'cryptoId'=>$request->cryptoId,'quantity'=>$request->amount,'validated'=>1],
       ]);
       return response()->json([
        'status_code'=>200,
        'message'=>"Dépot effectué avec succès",
       ]);

    }
}
