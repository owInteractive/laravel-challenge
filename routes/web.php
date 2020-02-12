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

Route::get('/', function() {
    return redirect('/event_list/all');
});

Route::get('/event_list/{period}', 'EventController@list');
Route::get('/event_list/show/{id}', 'EventController@show');
Route::post('/event_list/invite/send', 'InviteController@store')->name('invite-new');
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
        Route::get('/{id}/edit', 'EventController@edit');
        Route::put('/{id}', 'EventController@update');
        Route::delete('/{id}', 'EventController@destroy');
        Route::get('/export', 'EventController@export');
        Route::post('/import', 'EventController@import');
    });

    Route::prefix('invite')->group(function() {
        Route::post('/send', 'InviteController@store')->name('invite-new');
    });

    Route::prefix('home')->group(function() {
        Route::get('/{period}', 'HomeController@index');
    });
});