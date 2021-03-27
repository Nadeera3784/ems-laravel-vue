<?php

use Illuminate\Database\Seeder;

use App\Employe;
use Faker\Generator as Faker;

class EmployeesSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker){

        for($i = 1 ; $i <= 10 ; $i++){

            Employe::create([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'middle_name' => NULL,
                'address' => $faker->address,
                'city_id' => 1,
                'state_id' => 1,
                'department_id' => 1,
                'country_id' => 1,
                'zip' =>  $faker->postcode,
                'birthdate' => '2010-02-18',
                'date_hired' => NULL
            ]);

        }

    }
}
