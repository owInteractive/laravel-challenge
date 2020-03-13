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
use App\Http\Middleware\CheckTokenMiddleware;
use Illuminate\Routing\Router;

$route = app(Router::class);

$route->post('password/send', 'Base\\PasswordResetController@send');
$route->post('password/change', 'Base\\PasswordResetController@change');

$route
    ->group(['prefix' => 'utils'], function () use ($route) {
        $route->get('verify_token', 'Api\\UtilsController@verify_token');
        $route->get('export', 'Api\\EventsController@export')->middleware(CheckTokenMiddleware::class);
        $route->get('confirmation/{token}/{event}', 'Api\\UtilsController@confirmed')
            ->middleware(CheckTokenMiddleware::class)
            ->name('event.confirmed');
    });

$route
    ->middleware('auth:api')
    ->prefix('/')
    ->group(function () use ($route) {
        # user
        $route->get('user', 'Api\\UserController@me');
        $route->put('user', 'Api\\UserController@update');

        # users
        $route->get('users', 'Api\\UsersControllers@index');

        # events
        $route
            ->group(['prefix' => 'events'], function () use ($route) {
                $route->get('/', 'Api\\EventsController@index');
                $route->post('/', 'Api\\EventsController@store');
                $route->put('{event}', 'Api\\EventsController@update');
                $route->delete('{event}', 'Api\\EventsController@destroy');
            });
    });
