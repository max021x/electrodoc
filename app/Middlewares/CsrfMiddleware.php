<?php

namespace App\Middlewares ;

use Core\Middleware;
use Core\Router;
use App\Services\Csrf ; 

class CsrfMiddleware implements Middleware {

        public function handle(callable $next) {

            if(!Csrf::verify()){
                Router::pageExpired() ; 
            }

            return $next() ; 
        } 

}