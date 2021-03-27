<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder{

    public function run(){

        User::create([
            'username'   => 'john',
            'first_name' => 'john', 
            'last_name'  => 'doe',
            'email'      => 'johndoe@gmail.com',
            'password'   =>  Hash::make('password'),
            'role'       => 1
        ]);
    }
}
