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

use Illuminate\Routing\Router;

$route = app(Router::class);

$route->get('/', function () {return app()->version();});

$route->post('/login', 'Base\\LoginController');
$route->post('/register', 'Base\\RegisterController');
