<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;




class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function index()
    {
        $users = User::paginate();
 
        // return response()->json([
        //     'success' => true,
        //     'data' => $users
        // ]);
        return UserResource::collection($users)->response();

    }
 
    public function show($id)
    {

        $user = User::find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found '
            ], 400);
        }
        return (new UserResource($user))->response();

 
        // return response()->json([
        //     'success' => true,
        //     'data' => $user->toArray()
        // ], 400);
    }
 

 
    public function update(Request $request, $id)
    {
        $user = User::find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ], 400);
        }
 
         $updated = $user->update($request->all());
 
        if ($updated)
            return response()->json([
                'success' => true,
                'data' => $updated
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'user can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $user = User::find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ], 400);
        }
 
        if ($user->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user can not be deleted'
            ], 500);
        }
    }
}
