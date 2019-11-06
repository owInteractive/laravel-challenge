<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'event'], function () {
 Route::get('index/{order}', ['as' => 'event.index', 'uses' => 'EventController@index']);
 Route::get('create', ['as' => 'event.create', 'uses' => 'EventController@create']);
 Route::post('store', ['as' => 'event.store', 'uses' => 'EventController@store']);
 Route::get('edit/{id}', ['as' => 'event.edit', 'uses' => 'EventController@edit']);
 Route::put('update/{id}', ['as' => 'event.update', 'uses' => 'EventController@update']);
 Route::get('export/{flag}', ['as' => 'event.export', 'uses' => 'EventController@export']);
 Route::get('import', ['as' => 'event.import', 'uses' => 'EventController@import']);
 Route::post('import-data', ['as' => 'event.importData', 'uses' => 'EventController@importData']);
 Route::get('invite-friend{event}', ['as' => 'event.inviteFriend', 'uses' => 'EventController@inviteFriend']);
 Route::post('send-invite', ['as' => 'event.sendInvite', 'uses' => 'EventController@sendInvite']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
