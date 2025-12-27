<?php


namespace App\Controllers ;

use Core\Viewer;

class UserDashboardController {

    public function index () {
        return Viewer::render('user/index' , [] , 'layouts/main') ; 
    }


}