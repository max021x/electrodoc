<?php

namespace App\Models ;

use Core\Model;

class Contact extends Model {

    protected static string $table = 'contactmessages' ; 
    public $id; 
    public $name; 
    public $email; 
    public $message; 
    public $ip; 
    public $created_at;

}