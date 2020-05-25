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
    if(\Illuminate\Support\Facades\Auth::check())
        return redirect('/events');
    return view('index');
});

Auth::routes();

Route::middleware([
    'auth'
])->group(function () {
    //Profile Routes
    Route::get('/profile', 'UserController@profile');
    Route::put('/profile/update', 'UserController@updateDetails');
    Route::put('/profile/update_password', 'UserController@updatePassword');

    Route::resource('/events', 'EventController');

    Route::get('/exporter', function () {
        return view('events.import-export');
    });

    Route::get('/export', 'Invokables\\ExportEvents');
    Route::post('/import', 'Invokables\\ImportEvents');
});