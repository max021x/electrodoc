<?php

namespace App\Controllers  ;

use App\Models\Comment;
use App\Services\Auth;
use Core\Router;

class CommentController {


    public function store ($id) {

        $content = $_POST['content'];  

        // if(empty($content)) {
        // }

        // if(!$id){
        //     Router::notFound() ; 
        // }

        Comment::create(
            [
                "post_id" => $id , 
                "user_id" => Auth::user()->id , 
                "content" => $content 
            ]
        ) ; 


        Router::redirect("/posts/{$id}/#comments")  ; 
    }




}