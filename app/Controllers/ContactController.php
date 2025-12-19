<?php

namespace App\Controllers ;

use App\Models\Contact;
use Core\Router;
use Core\Viewer;

class ContactController {


    public function store () {
        
        $name = $_POST['name'] ; 
        $email = $_POST['email'] ; 
        $message = $_POST['message'] ; 
        $ip = $_SERVER["REMOTE_ADDR"]; 
        $data = [] ;  
        
        if(!empty($name)&&!empty($email)&&!empty($message)&&!empty($ip)){
            $data = [
                'name' => $name  ,
                'email' => $email , 
                'message' => $message , 
                'ip' => $ip
            ] ; 
            Contact::create($data) ;     
            Router::redirect('/') ; 
        }

        return Viewer::render('home/index' , ['error' => 'error'] , 'layouts/main') ; 

    }



}