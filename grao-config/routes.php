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
 //========================== event ================================ 
      Route::get('event', [
         'as'   => 'eventtoday.event.index',
         'permissao' => 'eventtoday.event.index',
         'uses' => 'Eventtoday\EventController@index',
       ]);
       Route::get('event/form/{id?}', [
         'as'   => 'eventtoday.event.form',
         'permissao' => 'eventtoday.event.form',
         'uses' => 'Eventtoday\EventController@form',
       ]);
       Route::post('event/create', [
         'as'   => 'eventtoday.event.create',
         'permissao' => 'eventtoday.event.create',
         'uses' => 'Eventtoday\EventController@create',
       ]);
       Route::post('event/update/{id}', [
         'as'   => 'eventtoday.event.update',
         'permissao' => 'eventtoday.event.update',
         'uses' => 'Eventtoday\EventController@update',
       ]);
       Route::get('event/destroy/{id}', [
         'as'   => 'eventtoday.event.destroy',
         'permissao' => 'eventtoday.event.destroy',
         'uses' => 'Eventtoday\EventController@destroy',
       ]);