<?php

namespace App\Controllers ;

use App\Models\Post;
use App\Models\User;
use Core\Router;
use Core\Viewer;

class PostController {

    public function index () {
        $posts = Post::getRecent(3)  ;
        return Viewer::render('posts/index' , ['posts' => $posts] , 'layouts/main') ; 
    }

    public function show ($id) {
        $post = Post::find($id) ; 
        $username = User::find($post->user_id)->name; 
        // var_dump($username) ; die ; 
        if(!$post) {
            Router::notFound() ; 
        }

        // $comments 
        return Viewer::render('posts/show' , ['post' => $post , 'author_name' => $username] , 'layouts/main') ; 
    }

}