<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Http\Resources\WalletResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class WalletController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function index()
    {
       $wallets = Wallet::paginate();

    //    if (!$wallets) {

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'wallet not found'
    //     ], 400);
    //  }
 
      return WalletResource::collection($wallets)->response();

        // return response()->json([
        //     'success' => true,
        //     'data' => $wallets
        // ]);
        
    }
 
    public function show($id)
    {
        $wallet = Wallet::find($id);
 
        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'wallet not found '
            ], 400);
        }
 
        return (new WalletResource($wallet))->response();

        // return response()->json([
        //     'success' => true,
        //     'data' => $wallet->toArray()
        // ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [             
          //  'idUser'=> 'required',
            'amount'=> 'required',
            'cryptoId'=> 'required',
            //'lastUserAdress'=> 'required'
           
        ]);
 
        $wallet = new wallet();
        $wallet->idUser = $request->idUser;
        $wallet->amount = $request->amount;
        $wallet->cryptoId = $request->cryptoId;
        $wallet->lastUserAdress = $request->lastUserAdress;



        $response = Wallet::create($request->all());


 
        if ($response)
            return response()->json([
                'success' => true,
                'data' => $wallet->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'wallet not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $wallet = Wallets::find($id);
 
        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'wallet not found'
            ], 400);
        }
 
        $updated = $wallet->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'wallet can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $wallet = Wallet::find($id);
 
        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'wallet not found'
            ], 400);
        }
 
        if ($wallet->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'wallet can not be deleted'
            ], 500);
        }
    }

    public function getUserWallet(){

        $currentuser=Auth::user();
        $currentid=Auth::user()->id;

        if(
            $UserAllWallets = Wallet::
            where('idUser', '=', $currentid)
            ->paginate())
            {
                // $wallets = Wallet($UserAllWallets)::paginate();
                
     
                return WalletResource::collection($UserAllWallets)->response();
        
              
            }
                else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Wallets not found'
                    ], 400);
                }
    
}
}