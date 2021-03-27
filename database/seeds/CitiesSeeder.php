<?php

use Illuminate\Database\Seeder;

use App\City;

class CitiesSeeder extends Seeder{

    public function run(){

        City::create([
           'state' => 1,
           'name' => 'Colombo'
        ]);

        City::create([
           'state' => 1,
           'name' => 'Moratuwa'
        ]);

        City::create([
           'state' => 1,
           'name' => 'Negombo'
        ]);

        City::create([
           'state' => 1,
           'name' => 'Kandy'
        ]);

    }
}
