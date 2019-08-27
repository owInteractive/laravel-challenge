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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

$fonte='events';
$caminho='my_events';
Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte]);

$caminho='today';
Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte]);

$caminho='next';
Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte]);

$caminho='all';
Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte]);

$fonte='invitations';$caminho=$fonte;
Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte]);
