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
    return view('home');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {  


  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/newEvents', function () {
      return view('events.create');
    });
  Route::post('/newEvents', 'EventController@store')->name('events.store');
  Route::get('/events', 'EventController@todayEvents')->name('events.index');
  Route::get('/eventsNext', 'EventController@nextFiveDays')->name('events.next');
  Route::get('/events/edit/{id}', 'EventController@edit')->name('events.edit');
  Route::get('/myEvents', 'EventController@myEvents')->name('events.myevents');
  Route::put('/events/edit/{id}', 'EventController@update')->name('events.update');
  Route::get('/allEvents', 'EventController@allEvents')->name('events.allevents');
  Route::delete('/events/edit/{id}', 'EventController@destroy')->name('events.destroy');
  Route::get('/myProfile', 'UserController@myProfile')->name('users.myprofile');
  Route::put('/myProfile/{id}', 'UserController@update')->name('users.update');
  Route::delete('/myProfile/{id}', 'UserController@destroy')->name('users.destroy');
});
