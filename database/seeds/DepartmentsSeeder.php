<?php

use Illuminate\Database\Seeder;

use App\Department;

class DepartmentsSeeder extends Seeder{

    public function run(){

        Department::create([
            'name' => 'IT'
        ]);

        Department::create([
            'name' => 'Marketing'
        ]);

        Department::create([
            'name' => 'Media'
        ]);

        Department::create([
            'name' => 'HR'
        ]);
    }
}
