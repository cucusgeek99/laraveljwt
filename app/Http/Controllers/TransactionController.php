<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Annonce;
use App\Models\Historical;



use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class TransactionController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function index()
    {
        $transactions = Transaction::paginate();
 
        // return response()->json([
        //     'success' => true,
        //     'data' => $transactions
        // ]);
        return TransactionResource::collection($transactions)->response();

    }
 
    public function show($id)
    {
        $transaction = Transaction::find($id);
 
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'transaction not found '
            ], 400);
        }
 
        // return response()->json([
        //     'success' => true,
        //     'data' => $transaction->toArray()
        // ], 400);
        // return TransactionResource::collection($transaction)->response();
        return (new TransactionResource($transaction))->response();


    }
 
    public function store(Request $request)
    {
        $this->validate($request, [            
             'amount'=> 'required',
             'annonceId'=> 'required',
             'senderId'=> 'required',
             'status'=> 'required',

           
        ]);
        $annonce = Annonce::find($request->annonceId);
        $annonceQuantMin = $annonce->quantMin;
        $annonceQuantMax = $annonce->quantMax;
        $annonceCryptoId = $annonce->cryptoId;
        if($request->amount > $annonceQuantMax || $request->amount < $annonceQuantMin){
            return response()->json([
                'success' => false,
                'message' => 'Quantité invalide'
            ], 400);
        }
         
        
        // var_dump($annonce->anNumber);
        
        $currentuser=Auth::user();
        $currentid=Auth::user()->id;
     
        $now = now();

 
        $transaction = new transaction();
        $transaction->idtransac = $transaction->idtransac;
        $transaction->amount = $request->amount;
      //  $transaction->cryptoId = $request->cryptoId;
        $transaction->senderId = $request->senderId;
        $transaction->receiverId = $currentid;
        $transaction->annonceId = $request->annonceId;

        $transaction->created_at = $now;
       // $transaction->end_at = $request->end_at;

        $response = Transaction::create($request->all());
   
    //     DB::table('historical')->insert([
    //         ['userId'=>$currentid,'type'=>2,'cryptoId'=>$annonceCryptoId,'quantity'=>$request->amount,'validated'=>1],
    //    ]);

    //     DB::table('historical')->insert([
    //         ['userId'=>$request->senderId,'type'=>1,'cryptoId'=>$annonceCryptoId,'quantity'=>$request->amount,'validated'=>1],
    //     ]);

        // DB::table('wallets')->where('idUser', $currentid)->where('cryptoId', $annonceCryptoId)->increment('amount', $request->amount);

        // DB::table('wallets')->where('idUser', $request->senderId)->where('cryptoId', $annonceCryptoId)->decrement('amount', $request->amount);
       
        if ($response)
        return (new TransactionResource($transaction))->response()->setStatusCode(201);

            // response()->json([
            //     'success' => true,
            //     'data' => $transaction->toArray()
            // ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'transaction not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $transaction = Transacion::find($id);
 
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'transaction not found'
            ], 400);
        }

        if($request->status==2){


        }
        if($request->status==3){


        }
        if($request->status==4){


            $amount=$transaction->amount;
            $senderid=$transaction->senderId;
            $oldSenderAmount=  DB::table('wallets')
            ->select('amount')
            ->where('userId', $senderid)
            ->where('cryptoId', 1)
            ->first();
            $newReceiverAmount=
            $newSenderAmount= 

            DB::transaction(function () {
                DB::update('update users set votes = 1');
             
                DB::delete('delete from posts');
            });


        }
 
        $updated = $transaction->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'transaction can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
 
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'transaction not found'
            ], 400);
        }
 
        if ($transaction->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'transaction can not be deleted'
            ], 500);
        }
    }

    public function getUserAllTransac(){
        $currentuser=Auth::user();
        $currentid=Auth::user()->id;

        if(
            $UserAllTransac = Transaction::
            where('senderId', '=', $currentid)
            ->paginate())
    
          {
            // $transactions = Transaction($UserAllTransac)::paginate();
            
 
            // return response()->json([
            //     'success' => true,
            //     'data' => $transactions
            // ]);
            return TransactionResource::collection($UserAllTransac)->response();
    
            //return AnnonceResource::collection($AnnoncebyCrypto)->response();
            // return response()->json([
            //     'success' => true,
            //     'data' => $UserAllTransac->toArray()->paginate()
    
            // ]);
        }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 400);
            }


    }
    //
}
