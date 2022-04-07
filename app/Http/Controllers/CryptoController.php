<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crypto;
use App\Http\Resources\CryptoResource;



class CryptoController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }
    public function index()
    {
        $cryptos = Crypto::paginate();

        return CryptoResource::collection($cryptos)->response();
 
        // return response()->json([
        //     'success' => true,
        //     'data' => $cryptos
        // ]);
    }
 
    public function show($id)
    {
        $crypto = Crypto::find($id);
 
        if (!$crypto) {
            return response()->json([
                'success' => false,
                'message' => 'crypto not found'
            ], 400);
        }
        return (new CryptoResource($crypto))->response();

 
        // return response()->json([
        //     'success' => true,
        //     'data' => $crypto->toArray()
        // ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [         
           
            'cryptoName'=> 'required',
            'cryptoSigle'=> 'required',
            'cryptoAddress'=> 'required',
            'cryptoImage'=> 'required'           
        ]); 
        $crypto = new crypto();
        $crypto->cryptoName = $request->cryptoName;
        $crypto->cryptoSigle = $request->cryptoSigle;
        $crypto->cryptoAddress = $request->cryptoAddress;
        $crypto->cryptoImage = $request->cryptoImage;


        $response = Crypto::create($request->all());
        // return response()->json($article, 201);

 
        if ( $response
            // auth()->user()->cryptos()->save($crypto)
            )
            return response()->json([
                'success' => true,
                'data' => $crypto->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'crypto not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $crypto = Crypto::find($id);
 
        if (!$crypto) {
            return response()->json([
                'success' => false,
                'message' => 'crypto not found'
            ], 400);
        }
 
        $updated = $crypto->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'crypto can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $crypto = Crypto::find($id);
 
        if (!$crypto) {
            return response()->json([
                'success' => false,
                'message' => 'crypto not found'
            ], 400);
        }
 
        if ($crypto->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'crypto can not be deleted'
            ], 500);
        }
    }
}
