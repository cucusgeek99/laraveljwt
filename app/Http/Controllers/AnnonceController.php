<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AnnonceResource;




class AnnonceController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register','getannonces']]);
    }
    public function index()
    {
        //$authuser = Auth::user(); 
        //$user;
       // $user['name']=$authuser->name;
       // $user['email']=$authuser->email;


        // $annonces = auth()->user()->annonce;

        // $companies = Company::with(['users']);
                $annonces = Annonce::paginate();

        return AnnonceResource::collection($annonces)->response();
        
            // return response()->json([
            //     'success' => true,
            //     'data' => $annonces
            // ]);
    }
 
    public function show($id)
    {
        $annonce = Annonce::find($id); 
        if (!$annonce) {
            return response()->json([
                'success' => false,
                'message' => 'annonce not found'
            ], 400);
        } 
        return (new AnnonceResource($annonce))->response();

        // return (new CompanyResource($company->loadMissing(['users'])))->response();

        // return response()->json([
        //     'success' => true,
        //     'data' => $annonce->toArray()
        // ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [   
            // 'iduser'=> 'required',       
          //  'anNumber'=> 'required',
            'dollarPrice'=> 'required',
            'quantMin'=> 'required',
            'quantMax'=> 'required',
            'cryptoId'=> 'required',
            'paymentMethodId'=> 'required'
        ]);
        $uuid = Str::uuid()->toString();
 
        $annonce = new Annonce();
      //  $annonce->iduser = $request->iduser;

     // $results = DB::select('select * from users where id = :id', ['id' => 1]);
     $userCrypto = DB::table('wallets')
     // ->join('annonces', 'users.id', '=', 'annonces.idUser')
     // ->join('wallets', 'users.id', '=', 'wallets.idUser')
     ->select('wallets.amount')
     ->where('wallets.cryptoId',$request->cryptoId)
     ->where('wallets.idUser',$request->idUser)
     ->get();
     //$users = DB::table('users')
       //         ->where('votes', '=', 100)
        //        ->where('age', '>', 35)
          //      ->get();

       
       
            
      
            //return $userCrypto;
            // return response()->json([
            //             'success' => true,
            //             'data' => $userCrypto
            //         ]);

        if($userCrypto>=$request->quantMax){
            $annonce->anNumber = $uuid;
            $annonce->dollarPrice = $request->dollarPrice;
            $annonce->quantMin = $request->quantMin;
            $annonce->quantMax = $request->quantMax;
            $annonce->cryptoId = $request->cryptoId;
            $annonce->paymentMethodId = $request->paymentMethodId;
    
 
        if (auth()->user()->annonce()->save($annonce))
            return response()->json([
                'success' => true,
                'data' => $annonce->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'annonce not added'
            ], 500);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'amount in wallet is insufficiant'
            ], 400);

        }
    }
 
    public function update(Request $request, $id)
    {
        $annonce = Annonce::find($id);
 
        if (!$annonce) {
            return response()->json([
                'success' => false,
                'message' => 'annonce not found'
            ], 400);
        }
 
        // $updated = $annonce->fill($request->all())->update();
 
        if ($annonce->update($request->all()))
            return response()->json([
                'success' => true,
                'data' => $annonce->toArray()

            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'annonce can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $annonce = auth()->user()->annonce()->find($id);
 
        if (!$annonce) {
            return response()->json([
                'success' => false,
                'message' => 'annonce not found'
            ], 400);
        }
 
        if ($annonce->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'annonce can not be deleted'
            ], 500);
        }
    }
    public function annoncebycrypto($sigle)
    {
        if(
        $AnnoncebyCrypto = Annonce::
         join('cryptos', 'annonces.cryptoId', '=', 'cryptos.idCrypto')
        ->select('annonces.*')
        ->where('cryptos.cryptoSigle', '=', $sigle)
        ->paginate())

      {
        $annoncesdata = $AnnoncebyCrypto;



        return AnnonceResource::collection($annoncesdata)->response();
        // return response()->json([
        //     'success' => true,
        //     'data' => $AnnoncebyCrypto->toArray()

        // ]);
    }
        else {
            return response()->json([
                'success' => false,
                'message' => 'annonce not found'
            ], 400);
        }

      

    }
}
