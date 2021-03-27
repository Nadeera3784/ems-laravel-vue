<?php

use Illuminate\Database\Seeder;


use App\State;

class StatesSeeder extends Seeder{

    public function run(){
        State::create([
            'name' => 'Central',
            'country' =>  1,
        ]);

        State::create([
            'name' => 'Eastern',
            'country' =>  1,
        ]);

        State::create([
            'name' => 'North Central',
            'country' =>  1,
        ]);

        State::create([
            'name' => 'Northern',
            'country' =>  1,
        ]);
        
        State::create([
            'name' => 'North Western',
            'country' =>  1,
        ]);
    }
}
