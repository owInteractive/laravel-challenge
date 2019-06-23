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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('event', 'EventController');

    Route::get('/csv/export', 'CsvController@export')->name('csv.export');
    Route::post('/csv/import', 'CsvController@import')->name('csv.import');
    Route::get('/csv/import', 'CsvController@importForm')->name('csv.import.form');
});


