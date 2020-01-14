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

// Events
Route::get('/create-event', 'EventsController@createEvent')->middleware('auth')->name('create-event');

Route::post('/store-event','EventsController@storeEvent')->middleware('auth');

Route::get('/your-events','EventsController@userEvents')->middleware('auth')->name('your-events');

Route::post('/export-event','EventsController@exportEvent')->middleware('auth')->name('export-event');

Route::post('/import-event','EventsController@importEvent')->middleware('auth')->name('import-event');

Route::get('/successful-import','EventsController@successfulImport')->middleware('auth')->name('successful-import');

Route::post('/delete-event','EventsController@deleteEvent')->middleware('auth')->name('delete-event');

Route::post('/edit-event','EventsController@editEvent')->middleware('auth')->name('edit-event');

Route::post('/update-event','EventsController@updateEvent')->middleware('auth')->name('update-event');