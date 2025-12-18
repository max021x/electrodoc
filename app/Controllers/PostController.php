<?php

namespace App\Controllers ;

use App\Models\Post;
use Core\Viewer;

class PostController {

    public function index () {
        $posts = Post::getRecent(3)  ;
        return Viewer::render('posts/index' , ['posts' => $posts] , 'layouts/main') ; 
    }


}