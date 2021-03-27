<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Country;

class CountryController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	$countries = Country::all();
        return view('country.index', ['countries' => $countries]);
    }

    public function create(){
    	return view('country.create');
    }

    public function store(Request $request){
    	$request->validate([
            'country_code' => 'required|string|max:3',
            'name' => 'required|string|max:60'
        ]);

        Country::create([
        	'country_code' => $request->country_code,
            'name' => $request->name
        ]);

        return redirect('sm/country')->with('success', 'Country has been created successfully!');   

    }

    public function edit($id){
        $country = Country::findOrFail(Crypt::decrypt($id));
        return view('country.edit', ['country'=> $country]);
    }

    public function update(Request $request, $id){

        $request->validate([
        	'country_code' => 'required|string|max:3',
            'name' => 'required|string|max:60'
        ]);

        $country = Country::findOrFail(Crypt::decrypt($id));

        $country->update([
        	'country_code'  => $request->country_code,
            'name' => $request->name
        ]);

        return redirect('sm/country')->with('success', 'Country has been updated successfully!');   
    }

    public function destroy($id){

        $country = Country::findOrFail($id);

        $is_deleted = $country->delete();

        if($is_deleted){
          return response()->json(['type' => "success", "message" => "Country has been deleted successfully!"], 200);
        }else{
          return response()->json(['type' => "danger", "message" => "Something went wrong, please try again later"], 400);
        }

    }
}