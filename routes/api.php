<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

////Rotas publicas
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');


////Rotas privadas
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::put('update-user/{id}', 'AuthController@updateUser');
    Route::resource('event','EventController');
    Route::post('event-send-mail','SendEmailInvitation@index');
    Route::post('upload','UploadImportEventCsvController@upload');
});


