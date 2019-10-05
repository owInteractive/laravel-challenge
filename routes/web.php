<?php

Route::get('/', 'EventController@getTodayEventsList')->name('events.index');
Route::get('/home', 'EventController@getTodayEventsList')->name('home');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {  


  Route::get('/newEvents', function () {
      return view('events.create');
    });
  Route::get('/import', 'EventController@importCsvView')->name('events.import');
  Route::post('/newEvents', 'EventController@storeEvent')->name('events.store');

  Route::get('/eventsNext', 'EventController@getNextFiveDaysEventsList')->name('events.next');
  Route::get('/allEvents', 'EventController@getAllEventsList')->name('events.allevents');
  Route::get('/events/{id}', 'EventController@showEvent')->name('events.show');

  Route::post('/import', 'EventController@storeImportedCSV')->name('events.importcsv');
  Route::get('/export/{archive}/{type}', 'EventController@exportListOfEvents')->name('events.export');

 
});



Route::middleware(['auth', 'section.owner'])->prefix('{user}')->group(function () {
 
  Route::get('myEvents', 'EventController@getMyEventsList')->name('events.myevents');

  Route::get('/events/edit/{id}', 'EventController@editEvent')->name('events.edit');
  Route::put('/events/edit/{id}', 'EventController@updateEvent')->name('events.update');
  Route::delete('/events/edit/{id}', 'EventController@destroyEvent')->name('events.destroy');

  Route::get('/myProfile', 'UserController@myProfile')->name('users.myprofile');
  Route::put('/myProfile', 'UserController@updateUser')->name('users.update');
  Route::delete('/myProfile', 'UserController@destroyUser')->name('users.destroy');


 
});
