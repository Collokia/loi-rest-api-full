<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    return str_random(32);
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->group(['middleware' => ['before' => 'jwt.auth', 'after' => 'jwt.refresh']], function () use ($router) {
        $router->get('/categories', 'CategoriesController@index');
    });
});