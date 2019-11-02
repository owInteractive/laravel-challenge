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
    return redirect()->route('login');
});

Auth::routes();
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/change-password', 'HomeController@showChangePasswordForm');

    Route::post('/change-password', 'HomeController@changePassword')
        ->name('change-password');

    Route::get('/my-account', 'HomeController@myAccount')
        ->name('my.account.get');

    Route::post('/my-account', 'HomeController@myAccount')
        ->name('my.account.post');

    Route::get('/dashboard', 'HomeController@index')
        ->name('dashboard');

    Route::resource('events', 'EventController');

    Route::post('events/{id}/update', 'EventController@update')
        ->name('events.patch');

    Route::get('/import/events', 'EventController@import')->name('events.import.get');

    Route::post('/import/events', 'EventController@importCSV')->name('events.import');

    Route::get('/export/{type}', 'EventController@downloadExcel')->name('events.export');
});



Route::get('/', function () {
    return redirect()->route('login');
})->name('start');

Route::get('refresh-csrf', function () {
    return csrf_token();
});

Route::get('refresh-session', function () {
    if (request()->session()->regenerate()) {
        return 'Session renewed!';
    }
});
