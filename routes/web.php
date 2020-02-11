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
Route::get('/', 'Admin\HomeController@index')->name('admin');

Route::prefix('/painel')->group(function() {
    
    Route::get('login', 'Admin\Auth\LoginController@index')->name('login');

    Route::post('login', 'Admin\Auth\LoginController@authenticate');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');    

    Route::get('register', 'Admin\Auth\RegisterController@index')->name('register');
    Route::post('register', 'Admin\Auth\RegisterController@register');    

    Route::get('profile', 'Admin\ProfileController@index')->name('profile');
    Route::put('profilesave', 'Admin\ProfileController@update')->name('profile.update');

    Route::get('events', 'Admin\EventsController@index');
    Route::get('events/today', 'Admin\EventsController@getEventsToday')->name('events.today');
    Route::get('events/lastdays', 'Admin\EventsController@getEventsNextDays')->name('events.lastdays');

    Route::resource('events', 'Admin\EventsController');
    
    Route::get('export', 'Admin\EventsController@export')->name('export');
    Route::get('eventsimport', 'Admin\EventsController@importExportView')->name('eventsimport');
    Route::post('import', 'Admin\EventsController@import')->name('import'); 

}); 

Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@index')->name('forgot');