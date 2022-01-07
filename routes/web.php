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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    // Admin Routes  api/admin
    $router->group(['middleware' => 'admin', 'prefix' => 'admin'], function () use ($router){
        $router->post('/logout', 'AuthController@logout');
        $router->get('/posts', 'AdminController@index');
        $router->delete('/posts/post/{id}', 'AdminController@destroy');
    });

    // User Routes api/
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/logout', 'AuthController@logout');
        $router->get('/get-user', 'UserController@getUser');
        $router->get('/user-details', 'UserController@userDetails');
        $router->post('/user-details', 'UserController@store');
        $router->put('/user-details-update/{id}', 'UserController@update');
        $router->get('/posts', 'PostController@index');
        $router->get('/my-posts', 'PostController@myPosts');
        $router->post('/posts', 'PostController@store');
        $router->put('/my-posts/my-post/{id}', 'PostController@update');
        $router->delete('/my-posts/my-post/{id}', 'PostController@destroy');
        $router->post('/posts/comment', 'CommentController@store');


    });
});