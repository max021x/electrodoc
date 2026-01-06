<?php

namespace App\Controllers;

use Core\Router;
use Core\Viewer;
use App\Services\Auth ; 

class AuthController
{


    public function index()
    {
        return Viewer::render('auth/login', ['dnone' => true], 'layouts/main');
    }

    public function auth()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (Auth::attempt($email, $password)) {
            Router::redirect('/');
        }

        $_SESSION['error'] = 'Invalid credentials email or password is not correct' ; 
        Router::redirect('/login') ; 
    }

    public function logout()
    {
        Auth::logout();
        Router::redirect('/login');
    }
}
