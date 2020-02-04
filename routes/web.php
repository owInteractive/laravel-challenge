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
//Event Auth
Route::get('/events','EventController@index')->name('events')->middleware('auth');
Route::get('/events/create','EventController@create')->name('new')->middleware('auth');
Route::post('/events/store','EventController@store')->name('store')->middleware('auth');
Route::get('/events/edit/{id}','EventController@edit')->name('edit')->middleware('auth');
Route::post('/events/update/{id}','EventController@update')->name('update')->middleware('auth');
Route::delete('/events/destroy/{id}','EventController@destroy')->name('destroy')->middleware('auth');
Route::get('/events/csv', 'EventCsvController@create')->name('csv.create')->middleware('auth');
Route::post('/events/csv/upload', 'EventCsvController@upload')->name('csv.upload')->middleware('auth');
Route::post('/events/csv/export', 'EventCsvController@export')->name('csv.export')->middleware('auth');

//Users
Route::get('/users/edit', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::post('/users/update', 'UserController@update')->name('users.update')->middleware('auth');


//Event Invite
Route::get('/events/invite/{id}', 'EventInviteController@create')->name('invite');
Route::post('/events/invite/store', 'EventInviteController@store')->name('invite.store');
