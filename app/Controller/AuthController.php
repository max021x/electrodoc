<?php

namespace App\Controller;

use Core\Viewer;

class AuthController
{

    public function index()
    {
        return Viewer::render(
            'auth/index',
            ['dnone' => true],
            'layouts/main'
        );
    }

    public function auth() {}

    public function logout() {}
}
