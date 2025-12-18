<?php

namespace App\Controllers;

use Core\Viewer;

class HomeController
{

    public function index()
    {
        return Viewer::render(
            'home/index',
            ['text' => 'Hello Dude'],
            'layouts/main'
        );
    }
}
