<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => ['api'],
    'prefix' => 'v1'

], function ($router) {
    Route::post('/login', 'Api\ApiController@login'); 
    Route::post('/register', 'Api\ApiController@register'); 
    Route::get('/refresh-token', 'Api\ApiController@refreshToken');
    Route::get('/me', 'Api\ApiController@me');
    Route::get('/employe-list', 'Api\ApiController@getEmployeList');
});