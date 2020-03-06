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

$route->post('password/send', 'Base\\PasswordResetController@send');
$route->post('password/change', 'Base\\PasswordResetController@change');

$route
    ->middleware('auth:api')
    ->prefix('/')
    ->group(function () use ($route) {
        # user
        $route->get('user', 'Api\\UserController@me');
        $route->put('user', 'Api\\UserController@update');

        # events
        $route
            ->group(['prefix' => 'events'], function () use ($route) {
                $route->get('/', 'Api\\EventsController@index');
                $route->get('export', 'Api\\EventsController@export');
                $route->post('/', 'Api\\EventsController@store');
                $route->put('{event}', 'Api\\EventsController@update');
                $route->delete('{event}', 'Api\\EventsController@destroy');
            });
    });
