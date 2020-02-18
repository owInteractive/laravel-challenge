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

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'EventController@index');
    //Events CRUD
    Route::resource('events', 'EventController');
    Route::get('events/filter/{filter}', 'EventController@filter')->name('events.filter');
    //CSV
    Route::get('import', 'ExcelController@index')->name('import');
    Route::get('export/{id?}', 'ExcelController@export')->name('export');
    Route::post('import', 'ExcelController@import')->name('import');
    //Invite
    Route::get('invite/{id}', 'InviteController@invite')->name('invite');
    Route::post('invite/{id}', 'InviteController@mail')->name('invite');
});
