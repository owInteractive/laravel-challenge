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

Route::group(['middleware'=>'auth:api'], function(){

	Route::apiResources([
		'events'  		=>'EventsController',
		'invitations'  	=>'InvitationsController',
	]);

	Route::post('events/import','EventsController@import');

	Route::get ('my_events', 'EventsController@owner');
	Route::get ('today', 'EventsController@today');
	Route::get ('next', 'EventsController@next');
	Route::get ('all', 'EventsController@index');

});
