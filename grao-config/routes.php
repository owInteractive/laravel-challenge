<?php 

 //========================== event ================================ 
      Route::get('event', [
         'as'   => 'event.event.index',
         'permissao' => 'event.event.index',
         'uses' => 'Event\EventController@index',
       ]);
       Route::get('event/form/{id?}', [
         'as'   => 'event.event.form',
         'permissao' => 'event.event.form',
         'uses' => 'Event\EventController@form',
       ]);
       Route::post('event/create', [
         'as'   => 'event.event.create',
         'permissao' => 'event.event.create',
         'uses' => 'Event\EventController@create',
       ]);
       Route::post('event/update/{id}', [
         'as'   => 'event.event.update',
         'permissao' => 'event.event.update',
         'uses' => 'Event\EventController@update',
       ]);
       Route::get('event/destroy/{id}', [
         'as'   => 'event.event.destroy',
         'permissao' => 'event.event.destroy',
         'uses' => 'Event\EventController@destroy',
       ]);
 //========================== event ================================ 
      Route::get('event', [
         'as'   => 'event.event.index',
         'permissao' => 'event.event.index',
         'uses' => 'Event\EventController@index',
       ]);
       Route::get('event/form/{id?}', [
         'as'   => 'event.event.form',
         'permissao' => 'event.event.form',
         'uses' => 'Event\EventController@form',
       ]);
       Route::post('event/create', [
         'as'   => 'event.event.create',
         'permissao' => 'event.event.create',
         'uses' => 'Event\EventController@create',
       ]);
       Route::post('event/update/{id}', [
         'as'   => 'event.event.update',
         'permissao' => 'event.event.update',
         'uses' => 'Event\EventController@update',
       ]);
       Route::get('event/destroy/{id}', [
         'as'   => 'event.event.destroy',
         'permissao' => 'event.event.destroy',
         'uses' => 'Event\EventController@destroy',
       ]);