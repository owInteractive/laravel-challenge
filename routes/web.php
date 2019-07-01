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
    return view('welcome');
});


Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::prefix(config('bredidashboard.prefix'))->middleware('auth', Bredi\BrediDashboard\Http\Middleware\ValidaPermissao::class)->group(
function () {

    Route::get('/', ['uses' => 'Controle\DashboardController@index'])->name('bredidashboard::dashboard');

    Route::get('events', ['uses' => 'Controle\EventController@index', /*'permissao' => 'controle.event.index'*/])->name('controle.event.index');
    Route::get('event/create', ['uses' => 'Controle\EventController@create', /*'permissao' => 'controle.event.create'*/])->name('controle.event.create');
    Route::get('event/show/{id}', ['uses' => 'Controle\EventController@show', /*'permissao' => 'controle.event.show'*/])->name('controle.event.show');
    Route::get('event/edit/{id}', ['uses' => 'Controle\EventController@edit', /*'permissao' => 'controle.event.edit'*/])->name('controle.event.edit');
    Route::post('event/store', ['uses' => 'Controle\EventController@store', /*'permissao' => 'controle.event.store'*/])->name('controle.event.store');
    Route::post('event/update/{id}', ['uses' => 'Controle\EventController@update', /*'permissao' => 'controle.event.update'*/])->name('controle.event.update');
    Route::get('event/delete/{id}', ['uses' => 'Controle\EventController@destroy', /*'permissao' => 'controle.event.destroy'*/])->name('controle.event.destroy');

    Route::get('events-today', ['uses' => 'Controle\EventTodayController@index', /*'permissao' => 'controle.event.today'*/])->name('controle.event.today');
    Route::get('events-next-days', ['uses' => 'Controle\EventTodayController@nextDays', /*'permissao' => 'controle.event.nextDays'*/])->name('controle.event.nextDays');

    Route::get('events/export/{period}', ['uses' => 'Controle\EventController@export', ])->name('controle.event.export');

    Route::get('accepting-invite/{token}', ['uses' => 'Controle\InviteController@accepting'])->name('controle.invite.accepting');    
});

Route::get('accept-invite/{token}', ['uses' => 'Controle\InviteController@accept'])->name('controle.invite.accept');
// Auth::routes();
