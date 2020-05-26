<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::post('/changePassword', 'HomeController@changePassword');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getTodayEvents', 'HomeController@getTodayEvents');
Route::get('/getNext5DaysEvents', 'HomeController@getNext5DaysEvents');

Route::get('/export', 'HomeController@export');

Route::get('/basicEvent', 'BasicEventController@basicEvent');
Route::post('/addBasicEvent', 'BasicEventController@addBasicEvent');
Route::get('/edit/{id}', 'BasicEventController@edit');
Route::post('/editBasicEvent/{id}', 'BasicEventController@editBasicEvent');
Route::get('/delete/{id}', 'BasicEventController@deleteBasicEvent');

Route::get('/friend', 'FriendController@index');
Route::get('/add', 'FriendController@add');
Route::post('/addFriend', 'FriendController@addFriend');
Route::get('/edit/{user_id}/{email}', 'FriendController@edit');
Route::post('/editFriend/{email}', 'FriendController@editFriend');
Route::get('/deleteFriend/{user_id}/{email}', 'FriendController@deleteFriend');

Route::get('/profile', 'ProfileController@profile');
Route::post('/editProfile', 'ProfileController@editProfile');

