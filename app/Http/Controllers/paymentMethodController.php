<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment_method;
use App\Http\Resources\paymentMethodResource;



class paymentMethodController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function index()
    {
       $Payment_methods = Payment_method::paginate();

       if (!$Payment_methods) {
        return response()->json([
            'success' => false,
            'message' => 'Payment_method not found'
        ], 400);
    }
 
        // return response()->json([
        //     'success' => true,
        //     'data' => $Payment_methods
        // ]);
        return paymentMethodResource::collection($Payment_methods)->response();


    }
 
    public function show($id)
    {
        $Payment_method = Payment_method::find($id);
 
        if (!$Payment_method) {
            return response()->json([
                'success' => false,
                'message' => 'Payment_method not found '
            ], 400);
        }
        return (new PaymentMethodResource($Payment_method))->response();
        

        // return response()->json([
        //     'success' => true,
        //     'data' => $Payment_method->toArray()
        // ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [             
            'paymentMethodName'=> 'required',
           
        ]);
 
        $Payment_method = new Payment_method();
        $Payment_method->paymentMethodName = $request->paymentMethodName;
      

        $response = Payment_method::create($request->all());


 
        if ($response)
            return response()->json([
                'success' => true,
                'data' => $Payment_method->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Payment_method not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $Payment_method = Payment_methods::find($id);
 
        if (!$Payment_method) {
            return response()->json([
                'success' => false,
                'message' => 'Payment_method not found'
            ], 400);
        }
 
        $updated = $Payment_method->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Payment_method can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $Payment_method = Payment_method::find($id);
 
        if (!$Payment_method) {
            return response()->json([
                'success' => false,
                'message' => 'Payment_method not found'
            ], 400);
        }
 
        if ($Payment_method->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Payment_method can not be deleted'
            ], 500);
        }
    }
}
