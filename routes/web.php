<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'Dashboard\DashboardController@index');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function () {
	
    Route::get('sm/department', 'Dashboard\DepartmentController@index')->name('sm.department');
    Route::get('sm/department/create-department', 'Dashboard\DepartmentController@create')->name('sm.department.create');
    Route::post('sm/department/store-department', 'Dashboard\DepartmentController@store')->name('sm.department.store');
    Route::get('sm/department/edit/{id}', 'Dashboard\DepartmentController@edit')->name('sm.department.edit');
    Route::post('sm/department/update/{id}', 'Dashboard\DepartmentController@update')->name('sm.department.update');
    Route::post('sm/department/delete/{id}', 'Dashboard\DepartmentController@destroy')->name('sm.department.delete');

    Route::get('sm/country', 'Dashboard\CountryController@index')->name('sm.country');
    Route::get('sm/country/create-country', 'Dashboard\CountryController@create')->name('sm.country.create');
    Route::post('sm/country/store-country', 'Dashboard\CountryController@store')->name('sm.country.store');
    Route::get('sm/country/edit/{id}', 'Dashboard\CountryController@edit')->name('sm.country.edit');
    Route::post('sm/country/update/{id}', 'Dashboard\CountryController@update')->name('sm.country.update');
    Route::post('sm/country/delete/{id}', 'Dashboard\CountryController@destroy')->name('sm.country.delete');

    Route::get('sm/state', 'Dashboard\StateController@index')->name('sm.state');
    Route::get('sm/state/create-state', 'Dashboard\StateController@create')->name('sm.state.create');
    Route::post('sm/state/store-state', 'Dashboard\StateController@store')->name('sm.state.store');
    Route::get('sm/state/edit/{id}', 'Dashboard\StateController@edit')->name('sm.state.edit');
    Route::post('sm/state/update/{id}', 'Dashboard\StateController@update')->name('sm.state.update');
    Route::post('sm/state/delete/{id}', 'Dashboard\StateController@destroy')->name('sm.state.delete');

    Route::get('sm/city', 'Dashboard\CityController@index')->name('sm.city');
    Route::get('sm/city/create-city', 'Dashboard\CityController@create')->name('sm.city.create');
    Route::post('sm/city/store-city', 'Dashboard\CityController@store')->name('sm.city.store');
    Route::get('sm/city/edit/{id}', 'Dashboard\CityController@edit')->name('sm.city.edit');
    Route::post('sm/city/update/{id}', 'Dashboard\CityController@update')->name('sm.city.update');
    Route::post('sm/city/delete/{id}', 'Dashboard\CityController@destroy')->name('sm.city.delete');

    Route::get('um/user', 'Dashboard\UserController@index')->name('um.user');
    Route::get('um/user/create-user', 'Dashboard\UserController@create')->name('um.user.create');
    Route::post('um/user/store-user', 'Dashboard\UserController@store')->name('um.user.store');
    Route::get('um/user/edit/{id}', 'Dashboard\UserController@edit')->name('um.user.edit');
    Route::post('um/user/update/{id}', 'Dashboard\UserController@update')->name('um.user.update');
    Route::post('um/user/delete/{id}', 'Dashboard\UserController@destroy')->name('um.user.delete');

    Route::get('um/role', 'Dashboard\RoleController@index')->name('um.role');
    Route::get('um/role/create-role', 'Dashboard\RoleController@create')->name('um.role.create');
    Route::post('um/role/store-role', 'Dashboard\RoleController@store')->name('um.role.store');
    Route::get('um/role/edit/{id}', 'Dashboard\RoleController@edit')->name('um.role.edit');
    Route::post('um/role/update/{id}', 'Dashboard\RoleController@update')->name('um.role.update');
    Route::post('um/role/delete/{id}', 'Dashboard\RoleController@destroy')->name('um.role.delete');

    Route::get('em/index', 'Dashboard\EMController@index')->name('em.index');
    Route::get('em/get-employee-list', 'Dashboard\EMController@getEmployeeListWithPaginate')->name('em.get.employee.list');
    Route::get('em/get-dropdown-data', 'Dashboard\EMController@getDropDownData')->name('em.get.dropdown.data');
    Route::post('em/employee/store-employee', 'Dashboard\EMController@store')->name('em.employee.store');
    Route::get('em/employee/edit/{id}', 'Dashboard\EMController@edit')->name('em.employee.edit');
    Route::post('em/employee/update/{id}', 'Dashboard\EMController@update')->name('em.employee.update');
    Route::post('em/employee/delete/{id}', 'Dashboard\EMController@destroy')->name('em.employee.delete');
});
