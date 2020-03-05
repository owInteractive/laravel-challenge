<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
use Illuminate\Routing\Router;

$route = app(Router::class);

$route
    ->middleware('auth:api')
    ->prefix('/')
    ->group(function () use ($route) {

        $route->get('user', 'Api\\UserController@me');
        $route->put('user', 'Api\\UserController@update');

    });
