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

use \App\Event;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {

        $events = Event::all()->where('starts_at', '>=', date('Y-m-d'));

        return view('events', compact('events'));
    })->middleware('guest');

    Route::get('/events', 'EventController@index');
    Route::post('/event', 'EventController@store');
    Route::delete('/event/{event}', 'EventController@destroy');

    Route::get('profile', 'UserController@edit');
    Route::post('update', 'UserController@update');

    Route::post('import', 'EventController@import');
    Route::get('export/{day}', 'EventController@export');
    Route::get('csv', 'EventController@csv');

    Route::auth();

});

Route::get('/home', 'EventController@index')->name('home');
Route::get('/five', 'EventController@fiveDays')->name('five');
Route::get('/today', 'EventController@today')->name('today');

Route::get('/eventDetail/{event}', 'EventDetailController@event')->name('eventDetail');

