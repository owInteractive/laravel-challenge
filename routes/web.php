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

    Route::post('/events/{event}/invite', 'EventController@invite');
    Route::get('/events/invite/{code}', 'EventController@confirm')->name('events.invite.confirm');
    Route::resource('events', 'EventController', ['except' => ['show', 'destroy']]);
    Route::get('/events/export', 'EventController@export')->name('events.export');
    Route::get('/events/import', 'EventController@import')->name('events.import');
    Route::post('/events/import', 'EventController@importCsv');

    Route::get('/profile', 'User\ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'User\ProfileController@update')->name('profile.update');
});

Route::group(['middleware' => 'auth', 'prefix' => 'api', 'as' => 'api'], function (){
    Route::apiResource('events', 'Api\EventController');
});
