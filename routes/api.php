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


Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('signin', 'AuthController@signin');
  Route::post('signup', 'AuthController@signup');
  Route::post('forgot', 'AuthController@forgot');
  Route::group([
    'middleware' => 'auth:api',
  ], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
    Route::post("newevent",'eventsController@store');
    Route::post("modifyprofile",'UserController@ModifyProfile');
    Route::post("modifypassword",'UserController@ModifyPassword');
    Route::get("events",'eventsController@index');
    Route::delete("events/{id}",'eventsController@destroy');
    Route::post("events/{id}",'eventsController@update');
    Route::post("importEvents",'eventsController@import');
    Route::get("exportEvents",'eventsController@export');
    Route::get("notifications",'NotificationController@index');
    Route::post("notifications",'NotificationController@store');
    Route::get("event/{id}",'eventsController@singleEvent');
    Route::get("eventfilter",'eventsController@eventsAfterFiveDays');
    Route::get("today_events",'eventsController@todayEvents');
    Route::delete("notification/{id}",'NotificationController@destroy');
  });
});
Route::resource("users", "UserController");
