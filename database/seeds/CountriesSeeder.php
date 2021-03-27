<?php

use Illuminate\Database\Seeder;

use App\Country;

class CountriesSeeder extends Seeder{

    public function run(){

        Country::create([
           'name' => 'Sri Lanka',
           'country_code' => '+94'
        ]);

        Country::create([
        	'name' => 'Australia',
            'country_code' => '+61'
        ]);

        Country::create([
            'name' => 'Germany',
            'country_code' => '+49'
        ]);
    }
}
