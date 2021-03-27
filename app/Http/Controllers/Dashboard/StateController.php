<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Country;
use App\State;

class StateController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	$states = State::with('country_id')->get();
        return view('state.index', ['states' => $states]);
    }

    public function create(){
    	$countries = Country::all();
    	return view('state.create', ['countries' => $countries]);
    }

    public function store(Request $request){
    	$request->validate([
            'country' => 'required',
            'name' => 'required|string|max:60'
        ]);

        State::create([
        	'country' => $request->country,
            'name' => $request->name
        ]);

        return redirect('sm/state')->with('success', 'State has been created successfully!');   

    }

    public function edit($id){
        $state = State::findOrFail(Crypt::decrypt($id));
        $countries = Country::all();
        return view('state.edit', ['state'=> $state, 'countries' => $countries]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'country' => 'required',
            'name' => 'required|string|max:60'
        ]);

        $state = State::findOrFail(Crypt::decrypt($id));

        $state->update([
            'country' => $request->country,
            'name' => $request->name
        ]);
        return redirect('sm/state')->with('success', 'State has been updated successfully!');   
    }

    public function destroy($id){

        $state = State::findOrFail($id);

        $is_deleted =  $state->delete();

        if($is_deleted){
          return response()->json(['type' => "success", "message" => "State has been deleted successfully!"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }
}