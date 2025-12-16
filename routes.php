<?php


$router->add('GET',  '/', 'HomeController@index');



// auth routes 
$router->add("GET", '/login' , 'AuthController@index');
// $router->add("POST", '/login');
// $router->add("POST", '/logout');

$router->add("GET" , '/register' , 'RegisterController@index');
// $router->add("POST" , '/register');


// admin dashboard
// $router->add("GET", '/admin');

// admin post 
// $router->add("GET", '/admin/posts');
// $router->add("GET", '/admin/posts/create');
// $router->add("POST", '/admin/posts/create');
// $router->add("GET", '/admin/posts/edit');
// $router->add("POST", '/admin/posts/edit');
// $router->add("POST", '/admin/posts/delete');


// user 
// $router->add("GET" , '/post/{id}') ; 
// $router->add("GET" , '/category/{slug}');
// $router->add("GET" , '/profile');

// comment add  