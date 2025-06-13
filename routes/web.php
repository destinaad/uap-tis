<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// Route untuk Auth (Register & Login)
$router->post('/register', 'AuthController@register'); // METHOD: POST
$router->post('/login', 'AuthController@login');     // METHOD: POST

// Route yang membutuhkan autentikasi
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/mahasiswa', 'MahasiswaController@index'); // METHOD: GET
    $router->get('/mahasiswa/{nim}', 'MahasiswaController@show'); // METHOD: GET
    $router->get('/mahasiswa/prodi/{prodi_id}', 'MahasiswaController@filterByProdi'); // METHOD: GET

    $router->get('/prodi', 'ProdiController@index'); // METHOD: GET
    $router->post('/prodi', 'ProdiController@store'); // METHOD:

    $router->get('/me', 'AuthController@me'); // METHOD: GET
});