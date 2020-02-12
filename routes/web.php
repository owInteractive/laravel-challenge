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
    return redirect('events');
});

Auth::routes();

Route::group(['middleware' => ['web', 'calendar-app-middleware']], function () {
    Route::resource('/events', 'EventsController');
    Route::post('/events/export', 'EventsController@export')->name('events.export');
    Route::post('/events/import', 'EventsController@import')->name('events.import');
    Route::get('/profile/index', 'ProfileController@index')->name('profile.index');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    Route::patch('/profile/changePassword', 'ProfileController@changePassword')->name('profile.changePassword');
});


