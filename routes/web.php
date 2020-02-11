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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('invite/rsvp',['as' => 'invite.rsvp', 'uses' => 'InviteController@confirm']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('event/today',['as' => 'event.today', 'uses' => 'EventController@today']);
	Route::get('event/five',['as' => 'event.five', 'uses' => 'EventController@five']);
	Route::get('event/export',['as' => 'event.export', 'uses' => 'EventController@export']);
	Route::put('event/import',['as' => 'event.import', 'uses' => 'EventController@import']);
	
	Route::resource('event', 'EventController');
	Route::get('invite/{event}',['as' => 'invite.index', 'uses' => 'InviteController@index']);
	Route::get('invite/create/{event}',['as' => 'invite.create', 'uses' => 'InviteController@create']);
	Route::post('invite/store/{event}',['as' => 'invite.store', 'uses' => 'InviteController@store']);
	Route::resource('invite', 'InviteController',['except' => ['index','create','store']]);

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

