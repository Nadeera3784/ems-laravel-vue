<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Employe;

class ApiController extends Controller{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->guard = "api";
    }


    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['type' => "error", "message" => $validator->errors()], 422);
        }
        
        if (! $token = auth($this->guard)->attempt($validator->validated())) {
            return response()->json(['type' => "error", "message" => 'Unauthorized'], 422);
        }

       return $this->createNewToken($token);

    }

    public function register(Request $request) {
       
        $validator = Validator::make($request->all(), [
            'role'       => 'required',
            'username'   => 'required|string|max:20',
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6'
        ]);

        if ($validator->fails()) {
           return response()->json(['type' => "error", "message" => $validator->errors()], 422);
        }else{

            User::create([
                'username'   => $request->username,
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'role'       => $request->role,
                'password'   =>  Hash::make($request->password)
            ]);
            
            return response()->json(['type' => "success", "message" => 'User has been registered successfully!'], 200);

        }

    }

    public function me() {
        return response()->json(auth($this->guard)->user());
    }
    
    public function getEmployeList(){

        $employe_list = Employe::orderBy('last_name', 'ASC')->get()->toArray();

        return response()->json($employe_list, 200);
    }

    public function refreshToken() {
        return $this->createNewToken(auth($this->guard)->refresh());
    }


    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
}