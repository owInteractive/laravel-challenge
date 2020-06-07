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
Route::get('/myevents', 'EventsController@myevents')->name('myevents');
Route::get('/today', 'EventsController@today')->name('today');
Route::get('/next', 'EventsController@next')->name('next');

Route::get('export', 'EventsController@export')->name('export');
Route::get('importExportView', 'EventsController@importExportView');
Route::post('import', 'EventsController@import')->name('import');

route::resource('Events','EventsController');

