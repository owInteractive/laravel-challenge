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
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'app'], function (){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('events', 'EventController', ['except' => ['show']]);

    Route::get('/profile', 'User\ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'User\ProfileController@update')->name('profile.update');
});

Route::group(['middleware' => 'auth', 'prefix' => 'api', 'as' => 'api'], function (){
    Route::apiResource('events', 'Api\EventController');
});
