<?php

use Illuminate\Support\Facades\Route;





Route::view('/', 'Home')->name('Home');

Route::get('/Portafolio','EventController@index')->name('Datos.index');
Route::get('/Portafolio/crear','EventController@create')->name('Datos.crear');
Route::get('/Portafolio/{editar}/editar','EventController@edit')->name('Datos.edit');
Route::patch('/Portafolio/{editar}','EventController@update')->name('Datos.update');

Route::post('/','EventController@store')->name('Datos.store');
Route::get('/Portafolio/{editar}','EventController@show')->name('Datos.show');
Route::delete('/Portafolio/{id}','EventController@destroy')->name('Datos.eliminar');

Route::get('/exportar', 'EventController@export')->name('exportar');;
//Route::get('/importar', 'EventController@import');
Route::post('/importar', 'EventController@import')->name('importar');





Route::view('/Contacto', 'Contacto')->name('Contacto');
Route::post('Contacto', 'EnventoController@store')->name('messages.store');




Auth::routes();

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/update', 'Auth\ResetPasswordController@reset');






