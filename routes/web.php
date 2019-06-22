<?php
//ROTA PARA USUARIO

Route::resource('/user', 'UserController');
//ROTAS PRESENCES
Route::any('/presence/invite','PresenceController@invite')->name('inviteFriend'); //Rota para busca de eventos TODOS
Route::resource('/presence', 'PresenceController');
//ROTAS EVENT
Route::any('/event/search/{search?}','EventController@index')->name('eventSearch'); //Rota para busca de eventos TODOS
Route::any('/event/my/{id}/{search?}','EventController@my')->name('MyEvents'); //Rota para MEUS eventos
Route::any('/event/5days/{search?}','EventController@fivedays')->name('5DaysEvents'); //Rota para eventos em 5 DIAS
Route::any('/event/today/{search?}','EventController@today')->name('ToDaysEvents'); //Rota para eventos HOJE 
Route::any('/event/exibe/{id}/{user}','EventController@exibe')->name('eventShow'); //Rota EXIBIR EVENTO
Route::any('/event/import','EventController@excelform')->name('importExcel');//ROTA PARA IMPORTAR CSV
Route::any('/event/csvsend','EventController@excelImport')->name('sendCsv');//ROTA UPLOAD CSV
Route::any('/event/invited/{id}/{search}','EventController@invites')->name('invites');//ROTA CONVITES RECEBIDOS CSV
Route::any('/event/pendinginvited/{id}/{search}','EventController@pinvites')->name('pedingdinvites');//ROTA CONVITES RECEBIDOS CSV

Route::any('/event/csvget/{id?}/{category?}/{search?}','EventController@exportExcel')->name('downloadCsv');//ROTAD DOWNLOAD CSV
  
Route::resource('/event', 'EventController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

