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

Route::get('/login', 'LoginController@index')->name('login');
Route::get('/register', 'RegisterController@index')->name('register');

Route::get('/forgot', 'ResetPasswordController@index')->name('forgot');
Route::get('/reset', 'ResetPasswordController@reset')->name('reset');

Route::get('/account', 'HomeController@account');
Route::get('/create', 'HomeController@create');
