<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class User extends Authenticatable{
class User extends Authenticatable implements JWTSubject {

    protected $fillable = [
        'username', 
        'first_name', 
        'last_name', 
        'email', 
        'password',
        'role'
    ];


    protected $hidden = [
        'password', 'remember_token'
    ];


    public function role_id(){
        return $this->belongsTo('App\Role', 'role', 'id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
