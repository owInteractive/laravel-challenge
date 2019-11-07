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

Route::get('/events/{event}/accept_invite/{token}', 'EventsController@accept_invite')->name('events.accept_invite');
Route::get('/events/{event}/reject_invite/{token}', 'EventsController@reject_invite')->name('events.reject_invite');
Route::post('/events/{event}/invite', 'EventsController@invite')->name('events.invite');
Route::get('/events/export', 'EventsController@export')->name('events.export');
Route::post('/events/import', 'EventsController@import')->name('events.import');
Route::resource('events','EventsController');

Route::resource('users', 'UsersController');