<?php

use App\Middlewares\AuthMiddleware;
use App\Middlewares\CsrfMiddleware;
use App\Middlewares\ViewMiddleware ;

$router->addGlobalMiddleware(ViewMiddleware::class) ; 
$router->addRouteMiddleware('auth' , AuthMiddleware::class) ; 
$router->addGlobalMiddleware(CsrfMiddleware::class) ; 

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

// admin posts
$router->add("GET", '/admin/posts', 'Admin\PostController@index');
$router->add("GET", '/admin/posts/create', 'Admin\PostController@create');
$router->add("POST", '/admin/posts/store' , 'Admin\PostController@store');
$router->add("GET", '/admin/posts/{id}/show', 'Admin\PostController@show');
$router->add("GET", '/admin/posts/{id}/edit' , 'Admin\PostController@edit');
$router->add("POST", '/admin/posts/{id}/update' , 'Admin\PostController@update');
$router->add("POST", '/admin/posts/{id}/delete' , 'Admin\PostController@delete');

// admin users 
$router->add("GET" , '/admin/users' , 'Admin\UserController@index') ;  
$router->add("GET" , '/admin/users/create' , 'Admin\UserController@create') ;  
$router->add("POST" , '/admin/users/store' , 'Admin\UserController@store') ;  
$router->add("GET" , '/admin/users/{id}/edit' , 'Admin\UserController@edit') ;  
$router->add("POST" , '/admin/users/{id}/update' , 'Admin\UserController@update') ;  
$router->add("POST" , '/admin/users/{id}/delete' , 'Admin\UserController@delete') ;  

// admin contact
$router->add('GET' , '/admin/contacts' , 'Admin\ContactController@index') ; 
$router->add('POST' , '/admin/contacts/{id}/delete' , 'Admin\ContactController@delete') ; 


// user 
$router->add("GET" , '/posts' , 'PostController@index') ; 
$router->add("GET" , '/posts/{id}' , 'PostController@show') ; 
$router->add("POST" , '/contact' , 'ContactController@store') ;

$router->add("POST" , '/posts/{id}/comments' , 'CommentController@store' , ['auth']) ; 
$router->add("GET" , '/dashboard' , 'UserDashboardController@index' , ['auth']);

