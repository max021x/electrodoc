<?php

use App\Middlewares\AuthMiddleware;
use App\Services\Auth;

use App\Middlewares\ViewMiddleware ; 


$router->addGlobalMiddleware(ViewMiddleware::class) ; 
$router->addRouteMiddleware('auth' , AuthMiddleware::class) ; 

// home
$router->add('GET',  '/', 'HomeController@index');

// auth routes 
$router->add("GET", '/login', 'AuthController@index');
$router->add("POST", '/login' , 'AuthController@auth' );
$router->add("POST", '/logout' , 'AuthController@logout' );

$router->add("GET", '/register', 'RegisterController@index');
// $router->add("POST" , '/register');


// admin routes 
$router->add("GET", '/admin/dashboard', 'Admin\DashboardController@index');
$router->add("GET", '/admin/posts', 'Admin\PostController@index');
$router->add("GET", '/admin/posts/create', 'Admin\PostController@create');
$router->add("POST", '/admin/posts/store' , 'Admin\PostController@store');
$router->add("GET", '/admin/posts/{id}/show', 'Admin\PostController@index');
$router->add("GET", '/admin/posts/{id}/edit' , 'Admin\PostController@edit');
$router->add("POST", '/admin/posts/{id}/update' , 'Admin\PostController@update');
$router->add("POST", '/admin/posts/{id}/delete' , 'Admin\PostController@delete');


// user 
$router->add("GET" , '/posts' , 'PostController@index') ; 
$router->add("GET" , '/posts/{id}' , 'PostController@show') ; 
$router->add("POST" , '/contact' , 'ContactController@store') ;

$router->add("POST" , '/posts/{id}/comments' , 'CommentController@store' , ['auth']) ; 
// $router->add("GET" , '/category/{slug}');
// $router->add("GET" , '/profile');

// comment add  