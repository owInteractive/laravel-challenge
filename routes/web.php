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



Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'HomeController@login')->name('login');
Route::get('/forgot', 'HomeController@forgot')->name('forgot');
Route::get('/reset', 'HomeController@reset')->name('reset');
Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('/register', 'HomeController@register')->name('register');
Route::get('/account', 'HomeController@account')->name('account');

Route::get('/create', 'HomeController@create');
