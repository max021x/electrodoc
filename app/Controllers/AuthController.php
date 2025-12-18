<?php

namespace App\Controllers;

use Core\Viewer;

class AuthController
{

    public function index()
    {
        return Viewer::render(
            'auth/login',
            ['dnone' => true],
            'layouts/main'
        );
    }

    public function auth() {}

    public function logout() {}
}
