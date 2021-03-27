<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Department;

class DepartmentController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
    	$departments = Department::all();
        return view('department.index', ['departments' => $departments]);
    }

    public function create(){
    	return view('department.create');
    }

    public function store(Request $request){
    	$request->validate([
            'name' => 'required|string|max:60'
        ]);

        Department::create([
            'name' => $request->name
        ]);

        return redirect('sm/department')->with('success', 'Department has been created successfully!');   

    }

    public function edit($id){
        $department = Department::findOrFail(Crypt::decrypt($id));
        return view('department.edit', ['department'=> $department]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:60'
        ]);

        $department = Department::findOrFail(Crypt::decrypt($id));

        $department->update([
            'name' => $request->name
        ]);
        return redirect('sm/department')->with('success', 'Department has been updated successfully!');   
    }


    public function destroy($id){

        $department = Department::findOrFail($id);

        $is_deleted = $department->delete();

        if($is_deleted){
          return response()->json(['type' => "success", "message" => "Department has been deleted successfully!"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }

}
