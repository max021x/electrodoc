<?php

namespace App\Services ;

use Core\Router;
use App\Models\Post ; 

class Authorization {

    public static function verify (string $action , mixed $resource = null) {
        if(!static::check($action , $resource)) {
            var_dump($action , $resource) ; 
            Router::forbidden() ; 
        }
    }


    public static function check (string $action , mixed $resource = null) {
        $user = Auth::user() ; 

        if(!$user){
            return false ;
        }

        if($user->role === "superadmin") {
            return true ; 
        }

        return match ($action) {
            'dashboard' => in_array($user->role , ['admin' , 'superadmin']) ,
            'edit_post','delete_post' => $resource instanceof Post && in_array($user->role, ['admin', 'superadmin']) ,
            'create_post' , => true , 
            default => false 
        } ;
    }

}