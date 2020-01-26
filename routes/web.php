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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    //Events Routes
    Route::get('/', 'EventController@index');
    Route::get('event', 'EventController@index')->name('event.index');
    Route::get('event/{id}', 'EventController@show')->name('event.show');
    Route::get('event/filter/{filter}', 'EventController@filter')->name('event.filter');
    Route::post('event', 'EventController@store')->name('event.store');
    Route::delete('event/{filter}', 'EventController@destroy')->name('event.destroy');

    //CSV Routes
    Route::get('import', 'CsvController@import')->name('import');
    Route::get('export', 'CsvController@exportAll')->name('export.all');
    Route::get('export/{id}', 'CsvController@exportSingle')->name('export.single');
    Route::post('import', 'CsvController@importCsv')->name('import');

    //Invite Routes
    Route::get('invite/{id}', 'InviteController@invite')->name('invite');
    Route::post('invite/{id}', 'InviteController@mail')->name('invite');

});
