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
    return redirect()->route('event');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/eventos', 'EventController@index')->name('event')->middleware('auth');
Route::get('/eventos/formulario/{id?}', 'EventController@formEvent')->name('event.form')->middleware('auth');
Route::post('/eventos/cadastrar', 'EventController@create')->name('event.create')->middleware('auth');
Route::get('/eventos/atualizar/{id}', 'EventController@update')->name('event.update')->middleware('auth');
Route::get('/eventos/deletar/{id}', 'EventController@delete')->name('event.delete')->middleware('auth');

Route::get('/eventos/{date}', 'EventController@filter')->name('filter')->middleware('auth');
