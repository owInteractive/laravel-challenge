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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('events/', 'EventController@index')->name('events.index');
        Route::get('events/today', 'EventController@eventsToday')->name('events.today');
        Route::get('events/nextFiveDays', 'EventController@eventsNextFiveDays')->name('events.nextFiveDays');

        Route::get('events/create', 'EventController@create')->name('events.create');
        Route::post('events', 'EventController@store')->name('events.store');

        Route::get('events/{event}/edit', 'EventController@edit')->name('events.edit');
        Route::put('events/{event}', 'EventController@update')->name('events.update');

        Route::delete('events/{event}', 'EventController@delete')->name('events.delete');

        // Import/Export CSV
        Route::post('events/import', 'EventController@import')->name('events.import');
        Route::get('events/export/{type_event}', 'EventController@export')->name('events.export');
    });
});
