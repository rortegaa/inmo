<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('layouts.administrator.app');
});

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::resource('states', 'StatesController');
    Route::resource('property_status', 'PropertyStatusController');
    Route::resource('property_types', 'PropertyTypesController');
    Route::resource('legal_status', 'PropertyLegalStatusController');
    Route::resource('property', 'PropertyController');
    Route::resource('services', 'ServicesController');
    
    route::get('security_social_area', 'AreasController@securityAndSocialIndex')->name('security_social.index');
    route::get('security_social_area/create', 'AreasController@securityAndSocialCreate')->name('security_social.create');
    route::get('security_social_area/delete/{id}', 'AreasController@securityAndSocialDelete')->name('security_social.delete');
    route::post('security_social_area', 'AreasController@securityAndSocialStore')->name('security_social.store');
});


Route::get('/home', 'HomeController@index')->name('home');
