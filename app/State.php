<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model{

    protected $fillable = [
        'country', 
        'name', 
    ];

    public function country_id(){
        return $this->belongsTo('App\Country', 'country', 'id');
    }

}
