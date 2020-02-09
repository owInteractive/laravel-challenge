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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserController@index')->name('profile');

    Route::put('/user', 'UserController@update')->name('user-update');

    Route::prefix('events')->group(function () {
        Route::get('/', 'EventController@index')->name('event-list');
    });

    Route::prefix('event')->group(function() {
        Route::get('/', 'EventController@create')->name('event-new');
        Route::post('/', 'EventController@store')->name('event-post');
    });
    
});