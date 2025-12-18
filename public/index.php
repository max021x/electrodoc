<?php

use App\Services\Auth;
use Core\Router;
use Core\Viewer;

require_once "../bootstrap.php" ; 

if(session_status() === PHP_SESSION_NONE) {
    session_start() ; 
}

$router = new Router ; 

require_once "../routes.php" ; 

Viewer::share("user" , Auth::user()) ; 


$uri = parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) ; 
$method = $_SERVER['REQUEST_METHOD'] ;

echo $router->dispatch($uri , $method) ; 
