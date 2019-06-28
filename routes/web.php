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

Route::prefix(config('bredidashboard.prefix'))->middleware('auth', Bredi\BrediDashboard\Http\Middleware\ValidaPermissao::class)->group(
function () {

    Route::get('events', ['uses' => 'Controle\EventController@index', 'permissao' => 'controle.event.index'])->name('controle.event.index');
    Route::get('event/create', ['uses' => 'Controle\EventController@create', 'permissao' => 'controle.event.create'])->name('controle.event.create');
    Route::get('event/edit/{id}', ['uses' => 'Controle\EventController@edit', 'permissao' => 'controle.event.edit'])->name('controle.event.edit');
    Route::post('event/store', ['uses' => 'Controle\EventController@store', 'permissao' => 'controle.event.store'])->name('controle.event.store');
    Route::post('event/update/{id}', ['uses' => 'Controle\EventController@update', 'permissao' => 'controle.event.update'])->name('controle.event.update');
    Route::get('event/delete/{id}', ['uses' => 'Controle\EventController@destroy', 'permissao' => 'controle.event.destroy'])->name('controle.event.destroy');

});
