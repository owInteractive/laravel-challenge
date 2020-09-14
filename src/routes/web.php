<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/registration/{token}', 'UserController@registration_view')->name('registration');
Route::POST('/registration', 'Auth\RegisterController@register')->name('accept');
Route::get('/users/invite', 'UserController@invite_view')->name('invite_view');
Route::post('/users/invite', 'UserController@process_invites')->name('process_invite');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UserController');
Route::resource('events','EventsController');
Route::get('todayEvents', 'EventsController@todayEvents');
Route::get('nextFiveDaysEvents', 'EventsController@nextFiveDaysEvents');
Route::get('importExportView', 'ExportEventsController@importExportView');
Route::get('export', 'ExportEventsController@export')->name('export');
Route::post('import', 'ExportEventsController@import')->name('import');
