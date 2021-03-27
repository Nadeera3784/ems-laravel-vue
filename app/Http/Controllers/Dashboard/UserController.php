<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserController extends Controller{

    public function __construct(){
       $this->middleware('auth');
    }

    public function index(){
    	$users = User::with('role_id')->get();
        return view('user.index', ['users' => $users]);
    }

    public function create(){
        $roles = Role::all();
        return view('user.create', ['roles'=> $roles]);
    }

    public function store(Request $request){
        $request->validate([
            'role'       => 'required',
            'username'   => 'required|string|max:20',
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6'
        ]);


        User::create([
            'username'   => $request->username,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   =>  Hash::make($request->password)
        ]);

        return redirect('um/user')->with('success', 'User has been created successfully!'); 
    }

    public function edit($id){
        $user = User::findOrFail(Crypt::decrypt($id));
        $roles = Role::all();
        return view('user.edit', ['user'=> $user, 'roles'=> $roles]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'role'       => 'required',
            'username'   => 'required|string|max:20',
            'first_name' => 'required|string|max:60',
            'last_name'  => 'required|string|max:60',
            'email'      => 'required|email'
        ]);

        $user = User::findOrFail(Crypt::decrypt($id));

        if($request->filled('password')){
           $user->password = Hash::make($request->password);
        }

        $user->username   = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->role       = $request->role;

        $user->save();

        return redirect('um/user')->with('success', 'User has been updated successfully!');   

    }

    public function destroy($id){
    	
        $user = User::findOrFail($id);

        $is_deleted =  $user->delete();

        if($is_deleted){
          return response()->json(['type' => "success", "message" => "User has been deleted successfully!"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }


}