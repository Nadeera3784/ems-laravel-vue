<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Response;
use Carbon\Carbon;

use App\Employe;
use App\Department;
use App\State;
use App\City;
use App\Country;

class EMController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('employe.index');
    }

    public function getEmployeeListWithPaginate(){
    	return Employe::with('city_id', 'department_id', 'country_id')->paginate(5);
    }

    public function getDropDownData(){

    	$departments = Department::all()->toArray();

		$states      = State::all()->toArray();

		$cities      = City::all()->toArray();

		$countries   = Country::all()->toArray();

        return Response::json([
        	'departments'=> $departments,
        	'states'     =>  $states,
        	'cities'     =>  $cities,
        	'countries'  =>  $countries
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:60',
            'last_name'    => 'required|string|max:60',
            'middle_name'  => 'nullable|max:60',
            'address'      => 'required|string|max:120',
            'city'         => 'required',
            'state'        => 'required',
            'department'   => 'required',
            'country'      => 'required',
            'zip'          => 'required|string|max:10',
        ]);


        if ($validator->fails()) {
            return response()->json(['type' => "error", "message" => "Something went wrong, please try again later"], 422);
        }else{
            
            $employe = new Employe;
            $employe->first_name  = $request->first_name;
            $employe->last_name   = $request->last_name;
            $employe->middle_name = $request->middle_name;
            $employe->address     = $request->address;
            $employe->city_id     = $request->city;
            $employe->state_id    = $request->state;
            $employe->department_id = $request->department;           
            $employe->country_id  = $request->country;
            $employe->zip         = $request->zip;
            $employe->birthdate   = ($request->birthdate) ? Carbon::parse($request->birthdate)->format('Y-m-d') : NULL;
            $employe->date_hired  = ($request->date_hired) ? Carbon::parse($request->date_hired)->format('Y-m-d') : NULL;
            $employe->save();
            
           	return response()->json(['type' => "success", "message" => "Employee has been added successfully"], 200);
        }
    }

    public function edit($id){

        $employee = Employe::findOrFail($id)->toArray();

        return Response::json([
            'employee'=> $employee
        ], 200);
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:60',
            'last_name'    => 'required|string|max:60',
            'middle_name'  => 'nullable|max:60',
            'address'      => 'required|string|max:120',
            'city'         => 'required',
            'state'        => 'required',
            'department'   => 'required',
            'country'      => 'required',
            'zip'          => 'required|string|max:10',
        ]);

 
       if ($validator->fails()) {
            return response()->json(['type' => "error", "message" => "Something went wrong, please try again later"], 422);
        }else{
            $employee = Employe::findOrFail($id);

            $employee->first_name  = $request->first_name;
            $employee->last_name   = $request->last_name;
            $employee->middle_name = $request->middle_name;
            $employee->address     = $request->address;
            $employee->city_id     = $request->city;
            $employee->state_id    = $request->state;
            $employee->department_id = $request->department;           
            $employee->country_id  = $request->country;
            $employee->zip         = $request->zip;
            $employee->birthdate   = ($request->birthdate) ? Carbon::parse($request->birthdate)->format('Y-m-d') : NULL;
            $employee->date_hired  = ($request->date_hired) ? Carbon::parse($request->date_hired)->format('Y-m-d') : NULL;
            $employee->save();

            return response()->json(['type' => "success", "message" => "Employee has been updated successfully"], 200);
        }
    }


    public function destroy($id){

        $employee = Employe::findOrFail($id);

        $is_deleted = $employee->delete();

        if($is_deleted){
          return response()->json(['type' => "success", "message" => "Employee has been deleted successfully"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }
}