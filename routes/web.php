<?php

/* No authenticated routes */
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('login', array('as' => 'login', 'uses' => 'Auth\LoginController@index'));
Route::post('login', array('as' => 'send_login', 'uses' => 'Auth\LoginController@authenticate'));
Route::get('register', array('as' => 'register', 'uses' => 'Auth\RegisterController@index'));
Route::post('register', array('as' => 'send_register', 'uses' => 'Auth\RegisterController@register'));
Route::get('logout', array('as' => 'logout', 'uses' => 'Auth\LoginController@logout'));
/*Events routes*/
Route::get('events/confirm_presence/{id_invite}', array('as' => 'invite_confirm', 'uses' => 'InvitesController@confirm'));
Route::get('events/refuse_presence/{id_invite}', array('as' => 'invite_refuse', 'uses' => 'InvitesController@refuse'));
/*End event routes*/

/*End no authenticated routes */

/*Authenticated routes*/
Route::group(['middleware' => ['auth']], function () {
    /* Events routes*/
    Route::get('events', array('as' => 'events', 'uses' => 'EventsController@index'));
    Route::get('events/next_days/{days?}', array('as' => 'events_next_days', 'uses' => 'EventsController@nextDays'));
    Route::get('events/today', array('as' => 'events_today', 'uses' => 'EventsController@today'));
    Route::get('events/view/{id_event}', array('as' => 'events_view', 'uses' => 'EventsController@edit'));
    Route::post('events/edit/{id_event}', array('as' => 'events_edit', 'uses' => 'EventsController@submit'));
    Route::get('events/delete/{id_event}', array('as' => 'events_delete', 'uses' => 'EventsController@delete'));
    Route::get('events/add', array('as' => 'events_add', 'uses' => 'EventsController@add'));
    Route::post('events/add', array('as' => 'events_create', 'uses' => 'EventsController@submit'));
    Route::post('events/import/csv', array('as' => 'import_csv', 'uses' => 'EventsController@importCsv'));
    Route::get('events/export/csv', array('as' => 'export_csv', 'uses' => 'EventsController@exportCsv'));
    Route::get('events/invite/{id_event}', array('as' => 'invite', 'uses' => 'InvitesController@index'));
    Route::post('events/invite/{id_event}', array('as' => 'send_invite', 'uses' => 'InvitesController@sendInvite'));
    Route::get('profile', array('as' => 'profile', 'uses' => 'Auth\AccountController@index'));
    Route::post('profile', array('as' => 'update_profile', 'uses' => 'Auth\AccountController@updateAccount'));
    /*End event routes*/
});
/*End authenticated routes*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
