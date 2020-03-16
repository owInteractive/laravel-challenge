<?php

Auth::routes();


Route::resource('/events', 'EventController', ['except' => ['show']]);
Route::post('/events/{event}/invite', 'InviteController')->name('events.invite');
