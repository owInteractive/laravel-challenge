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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/events/import','EventController@import')->name('events.import');
    Route::get('/events/export','EventController@exportEvents')->name('events.export');
    Route::post('/events/importEvents','EventController@importEvents')->name('events.importEvents');
    Route::resource('/events', 'EventController');
    
    Route::get('/home', 'HomeController@index')->name('home');
});
