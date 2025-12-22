<?php

use App\Services\Authorization;
use App\Services\Csrf;

if (!function_exists("check")) {
    function check($action, $resource = null)
    {
        return Authorization::check($action, $resource);
    }
}


if(!function_exists("csrf_token")) {
    function csrf_token () {
        $token = Csrf::getToken() ;
        $name = Csrf::TOKEN_NAME ; 
        return "<input type='hidden' " . "name=" .$name. " value=" .$token . ">" ; 
    }
}