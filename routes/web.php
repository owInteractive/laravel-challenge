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
    Route::get('/', 'EventController@index');
    //Events CRUD
    Route::get('event', 'EventController@index')->name('event.index');
    Route::get('event/{id}', 'EventController@show')->name('event.show');
    Route::get('event/filter/{filter}', 'EventController@filter')->name('event.filter');
    Route::post('event', 'EventController@store')->name('event.store');
    Route::delete('event/{filter}', 'EventController@destroy')->name('event.destroy');
    //CSV
    Route::get('import', 'ExcelController@import')->name('import');
    Route::get('export', 'ExcelController@exportAll')->name('export.all');
    Route::get('export/{id}', 'ExcelController@exportSingle')->name('export.single');
    Route::post('import', 'ExcelController@importExcel')->name('import');
    //Invite
    Route::get('invite/{id}', 'InviteController@invite')->name('invite');
    Route::post('invite/{id}', 'InviteController@mail')->name('invite');
});
