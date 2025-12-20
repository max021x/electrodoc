<?php

namespace App\Middlewares ;

use App\Services\Auth;
use Core\Router ; 
class AuthMiddleware {

    public function handle (callable $next) {
        $user = Auth::user() ; 
        if(!$user) {
            Router::unauthorized() ; 
        }

        return $next() ; 
    }

}