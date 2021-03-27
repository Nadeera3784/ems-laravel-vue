<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

    public function run(){
    	
        $this->call([
            RoleSeeder::class,
         	UserSeeder::class, 
         	CountriesSeeder::class,
            StatesSeeder::class,
            CitiesSeeder::class,
            DepartmentsSeeder::class,
            EmployeesSeeder::class
        ]);
    }
}
