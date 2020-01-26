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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/events', 'EventController');

    /** Event Routes */
    Route::get('/events/import','EventController@import')->name('events.import');
    Route::get('/events/export','EventController@exportEvents')->name('events.export');
    Route::post('/events/importEvents','EventController@importEvents')->name('events.importEvents');

    /** Home Routes */
    Route::get('/home', 'HomeController@index')->name('home');

    
    
});

Route::get('/confirmevent/successconfirm','ConfirmEventController@successConfirmation')->name('confirmevent.successconfirm');
Route::post('/confirmevent/store','ConfirmEventController@store')->name('confirmevent.store');
Route::get('/confirmevent/{id}','ConfirmEventController@index')->name('confirmevent.index');

