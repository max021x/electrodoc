<?php

namespace App\Services ;

use App\Models\Contact;
use Core\Router;
use App\Models\Post ;
use App\Models\User;

class Authorization {

    public static function verify (string $action , mixed $resource = null) {
        if(!static::check($action , $resource)) {
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
            'edit_user','delete_user' => $resource instanceof User && in_array($user->role, ['admin', 'superadmin']) ,
            'delete_contact' => $resource instanceof Contact && in_array($user->role, ['admin', 'superadmin']) ,
            'create_post' , => true , 
            default => false 
        } ;
    }

}