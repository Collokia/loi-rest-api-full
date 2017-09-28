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

$router->get('/categories', 'CategoriesController@index');
$router->get('/auth/first-user-token', 'AuthController@getFirstUserToken');
$router->get('/auth/default-token', 'AuthController@getByDefaultToken');
$router->post('/auth/login', 'AuthController@loginWithAuth');
$router->post('/auth/jwt-login', 'AuthController@loginWithJwt');
$router->post('/authenticate', 'AuthController@authenticate');