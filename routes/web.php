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
    return redirect()->route('login');

});    


Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('usuario', 'UserController');
    Route::post('usuario/{id}',['as'=> 'usuario.update','uses'=>'UserController@update']);

    Route::resource('event','EventController');
    Route::post('event/{id}',['as'=> 'event.update','uses'=>'EventController@update']);
    Route::get('event/deletar/{id}',['as'=> 'event.destroy','uses'=>'EventController@destroy']);
    Route::post('event/get/nowDay',['as'=> 'event.nowDay','uses'=>'EventController@nowDay']);
    Route::post('event/get/nextDay',['as'=> 'event.nextDay','uses'=>'EventController@nextDay']);
    Route::get('exportCsv/{type}','EventController@export')->name('eventE');
    Route::post('importExcel', 'EventController@import')->name('importExcel');
    Route::post('mail','EventController@mail')->name('mail');
});