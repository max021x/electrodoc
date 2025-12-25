<?php

namespace App\Models ;

use Core\Model;

class PostViews extends Model {

    protected static string $table = "post_views" ; 
    
    public $id ; 
    public $post_id ; 
    public $ip_address ; 
    

}