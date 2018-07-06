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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiresource('users', 'User\UserController');
Route::apiresource('users.events', 'User\UserEventController', ['except' => 'show']);
Route::get('/users/{user}/export', 'User\UserEventController@export');

Route::apiresource('events', 'Event\EventController', ['only' => ['show']]);