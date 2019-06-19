<?php

//ROTAS EVENT
Route::resource('/event', 'EventController');
Route::any('/event/search/{search?}','EventController@index')->name('eventSearch'); //Rota para busca de eventos
Route::any('/event/show/{id?}{user}','EventController@exibe')->name('eventShow'); //Rota para busca de eventos

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

