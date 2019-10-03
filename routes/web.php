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


Route::get('/', 'EventController@todayEvents')->name('events.index');
Route::get('/home', 'EventController@todayEvents')->name('home');


Auth::routes();
Route::group(['middleware' => ['auth']], function () {  


  Route::get('/newEvents', function () {
      return view('events.create');
    });
  Route::get('/import', function () {
    return view('import');
  });
  Route::post('/newEvents', 'EventController@store')->name('events.store');
  //Route::get('/events', 'EventController@todayEvents')->name('events.index');
  Route::get('/eventsNext', 'EventController@nextFiveDays')->name('events.next');
  Route::get('/allEvents', 'EventController@allEvents')->name('events.allevents');
  Route::post('/importCSV', 'EventController@importCSV')->name('events.importcsv');
  Route::get('/export/{archive}/{type}', 'EventController@export')->name('events.export');
  Route::get('/events/{id}', 'EventController@show')->name('events.show');

 
});



Route::middleware(['auth', 'section.owner'])->prefix('{user}')->group(function () {
 
  Route::get('myEvents', 'EventController@myEvents')->name('events.myevents');
  Route::get('/events/edit/{id}', 'EventController@edit')->name('events.edit');
  Route::put('/events/edit/{id}', 'EventController@update')->name('events.update');
  Route::delete('/events/edit/{id}', 'EventController@destroy')->name('events.destroy');
  Route::get('/myProfile', 'UserController@myProfile')->name('users.myprofile');
  Route::put('/myProfile/{id}', 'UserController@update')->name('users.update');
  Route::delete('/myProfile/{id}', 'UserController@destroy')->name('users.destroy');


 
});
