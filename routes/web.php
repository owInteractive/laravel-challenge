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

Auth::routes();

Route::get('/', function ()
{
	return redirect()->route('events.index');
});

Route::group(['middleware' => ['auth']], function ()
{
	Route::resource('events', 'EventController');
	
	Route::get('import', 'ExcelController@create')
		->name('import');
	Route::post('import', 'ExcelController@import')
		->name('import');
	
	Route::get('export/{id?}', 'ExcelController@export')
		->name('export');
	
	Route::get('invite/{id}', 'InviteController@create')
		->name('invite');
	Route::post('invite/{id}', 'InviteController@store')
		->name('invite');
	
	Route::resource('users', 'UserController');
});
