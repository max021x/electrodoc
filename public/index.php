<?php

use Core\Router;

require_once "../vendor/autoload.php" ; 

$router = new Router ; 

require_once "../routes.php" ; 


$uri = parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) ; 
$method = $_SERVER['REQUEST_METHOD'] ;

echo $router->dispatch($uri , $method) ; 
