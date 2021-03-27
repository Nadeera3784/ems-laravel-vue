<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model{

    protected $fillable = [
        'last_name', 
        'first_name', 
        'address', 
        'department_id', 
        'city_id', 
        'state_id', 
        'country_id', 
        'zip'
    ];

    public function city_id(){
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function department_id(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function state_id(){
        return $this->belongsTo('App\State', 'state_id', 'id');
    }

    public function country_id(){
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }
}
