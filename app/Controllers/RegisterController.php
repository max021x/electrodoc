<?php

namespace App\Controllers;
use Core\Viewer ; 

class RegisterController
{

    public function index()
    {
        return Viewer::render(
            'auth/register',
            ['dnone' => true],
            'layouts/main'
        );
    }
}
