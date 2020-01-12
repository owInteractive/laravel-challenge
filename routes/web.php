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

Route::get('/', 'DashboardController@index')->middleware('auth');

Route::group(['prefix' => 'events', 'middleware' => 'auth'], function() {

    Route::get('', 'EventsController@index');
    Route::get('create', 'EventsController@create');
    Route::post('create', 'EventsController@store');

    Route::get('import-export', 'EventsController@showImportExportPage');
    Route::post('import', 'EventsController@importEvents');
    Route::post('export', 'EventsController@exportEvents');

    Route::get('join/{token}', 'EventsController@acceptInvite');

    Route::group(['middleware' => 'event.owner'], function() {
        Route::put('{id}', 'EventsController@update')->where('id', '[0-9]+');
        Route::post('{id}/invite', 'EventsController@invite')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => 'event.participant'], function() {
        Route::get('{id}', 'EventsController@show')->where('id', '[0-9]+');
        Route::delete('{id}', 'EventsController@destroy')->where('id', '[0-9]+');
    });

});

Auth::routes();

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function() {

    Route::get('', 'ProfileController@index');
    Route::put('', 'ProfileController@update');
    Route::put('change-password', 'ProfileController@updatePassword');

});
