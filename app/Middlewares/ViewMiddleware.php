<?php


namespace App\Middlewares;

use Core\Middleware;
use Core\Viewer ; 
use App\Services\Auth ; 

class ViewMiddleware implements Middleware
{
    public function handle(callable $next)
    {
        Viewer::share("user", Auth::user());

        return $next() ; 
    }
}
