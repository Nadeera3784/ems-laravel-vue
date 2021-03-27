<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Role;

class RoleController extends Controller{

    public function __construct(){
       $this->middleware('auth');
    }

    public function index(){
    	$roles = Role::all();
        return view('role.index', ['roles' => $roles]);
    }


    public function create(){
        return view('role.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'   => 'required|string|max:20',
        ]);


        Role::create([
            'name'   => $request->name
        ]);

        return redirect('um/role')->with('success', 'Role has been created successfully!'); 
    }

    public function edit($id){
        $role = Role::findOrFail(Crypt::decrypt($id));
        return view('role.edit', ['role'=> $role]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:20'
        ]);

        $role = Role::findOrFail(Crypt::decrypt($id));

        $role->update([
            'name' => $request->name
        ]);
        return redirect('um/role')->with('success', 'Role has been updated successfully!');   
    }

    public function destroy($id){

        $role = Role::findOrFail($id);

        $is_deleted = $role->delete();
    
        if($is_deleted){
          return response()->json(['type' => "success", "message" => "Role has been deleted successfully!"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }
 }