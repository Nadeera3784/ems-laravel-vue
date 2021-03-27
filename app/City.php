<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model{

    protected $fillable = [
        'state', 
        'name'
    ];

    public function state_id(){
        return $this->belongsTo('App\State', 'state', 'id');
    }

}
