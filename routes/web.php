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


Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('layouts.administrator.dashboard');
    });
    Route::resource('states', 'StatesController');
    Route::resource('property_status', 'PropertyStatusController');
    Route::resource('property_types', 'PropertyTypesController');
    Route::resource('legal_status', 'PropertyLegalStatusController');
    Route::resource('property', 'PropertyController');
    Route::resource('services', 'ServicesController');
    Route::resource('type_of_interest_point', 'TypeOfInterestPointController');
    Route::resource('interest_point', 'InterestPointController');
    route::get('security_social_area', 'AreasController@securityAndSocialIndex')->name('security_social.index');
    route::get('security_social_area/create', 'AreasController@securityAndSocialCreate')->name('security_social.create');
    route::get('security_social_area/edit/{id}', 'AreasController@securityAndSocialEdit')->name('security_social.edit');
    route::post('security_social_area/edit/{id}', 'AreasController@securityAndSocialUpdate')->name('security_social.update');
    route::get('security_social_area/delete/{id}', 'AreasController@securityAndSocialDelete')->name('security_social.delete');
    route::post('security_social_area', 'AreasController@securityAndSocialStore')->name('security_social.store');
});


Route::get('/home', 'HomeController@index')->name('home');
