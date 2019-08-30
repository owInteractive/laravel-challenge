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

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', function () {
		return redirect('/all');
	});

	$fonte='events';
	$caminho='my_events';$titulo='My Events';
	Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte, 'titulo' => $titulo]);

	$caminho='today';$titulo='Events of Today';
	Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte, 'titulo' => $titulo]);

	$caminho='next';$titulo='Events for Next 5 Days';
	Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte, 'titulo' => $titulo]);

	$caminho='all';$titulo='All Events';
	Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte, 'titulo' => $titulo]);

	$fonte='invitations';$caminho=$fonte;$titulo='Invitations Sent';
	Route::view('/'.$caminho, 'home', ['caminho' => $caminho , 'fonte' => $fonte, 'titulo' => $titulo]);

});
