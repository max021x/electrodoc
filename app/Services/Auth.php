<?php

namespace App\Services ; 
use App\Models\User ;
use Core\Router;

class Auth {

    protected static $user  = null ; 

    public static function attempt (string $email , string $password) {
        $user = User::findByEmail($email) ;
        
        if($user->status !== 1) {
            return false ; 
        }   

        if($user && password_verify($password , $user->password)) {
            session_regenerate_id(true) ; 
            $_SESSION['user_id'] = $user->id ; 
            return true ; 
        }

        return false ; 
    }

    public static function user () {
        if(static::$user === null) {
            $userId = $_SESSION['user_id'] ?? null ; 
            static::$user = $userId ? User::find($userId) : null ; 
        }

    return static::$user; 
    }

    public static function logout () {
        session_destroy() ; 
        static::$user = null ; 
    }


}