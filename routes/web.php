<?php

Auth::routes();


Route::resource('/events', 'EventController', ['except' => ['show']]);
