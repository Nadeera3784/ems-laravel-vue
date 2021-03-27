<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\City;
use App\State;

class CityController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	$cities = City::with('state_id')->get();
        return view('city.index', ['cities' => $cities]);
    }

    public function create(){
    	$states = State::all();
    	return view('city.create', ['states' => $states]);
    }

    public function store(Request $request){
    	$request->validate([
            'state' => 'required',
            'name' => 'required|string|max:60'
        ]);

        City::create([
        	'state' => $request->state,
            'name' => $request->name
        ]);

        return redirect('sm/city')->with('success', 'City has been created successfully!');   

    }

    public function edit($id){
        $city = City::findOrFail(Crypt::decrypt($id));
        $states = State::all();
        return view('city.edit', ['city'=> $city, 'states' => $states]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'state' => 'required',
            'name' => 'required|string|max:60'
        ]);

        $city = City::findOrFail(Crypt::decrypt($id));

        $city->update([
            'state' => $request->state,
            'name' => $request->name
        ]);
        return redirect('sm/city')->with('success', 'City has been updated successfully!');   
    }

    public function destroy($id){

        $city = City::findOrFail($id);

        $is_deleted = $city->delete();

        if($is_deleted){
          return response()->json(['type' => "success", "message" => "City has been deleted successfully!"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }
}