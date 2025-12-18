<?php


$router->add('GET',  '/', 'HomeController@index');



// auth routes 
$router->add("GET", '/login', 'AuthController@index');
// $router->add("POST", '/login');
// $router->add("POST", '/logout');

$router->add("GET", '/register', 'RegisterController@index');
// $router->add("POST" , '/register');


// admin routes 
$router->add("GET", '/admin/dashboard', 'Admin\DashboardController@index');
$router->add("GET", '/admin/posts', 'Admin\DashboardController@posts');
$router->add("GET", '/admin/posts/create', 'Admin\DashboardController@create');
// $router->add("POST", '/admin/posts/store' , 'Admin\DashboardController@store');
// $router->add("GET", '/admin/{post}/edit' , 'Admin\DashboardController@edit');
// $router->add("POST", '/admin/{post}/update' , 'Admin\DashboardController@update');
// $router->add("POST", '/admin/{post}/delete' , 'Admin\DashboardController@delete');


// user 
$router->add("GET" , '/posts' , 'PostController@index') ; 
$router->add("GET" , '/posts/{id}' , 'PostController@show') ; 
// $router->add("GET" , '/category/{slug}');
// $router->add("GET" , '/profile');

// comment add  