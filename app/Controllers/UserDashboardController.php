<?php


namespace App\Controllers ;

use App\Models\Post;
use App\Models\SavedPost;
use App\Services\Auth;
use Core\Router;
use Core\Viewer;

class UserDashboardController {

    public function index () {
        $page = $_GET['page'] ?? 1 ; 
        $limit = 12 ; 
        $posts = SavedPost::getRecent(limit:$limit , page:$page) ;
        return Viewer::render('user/index' , ['savedPosts' => $posts] , 'layouts/main') ; 
    }

    public function save ($id) {
        // if(!Post::find($id)){
        // }

        SavedPost::create(
            [
                'user_id' => Auth::user()->id , 
                'post_id' => $id  , 
            ]
        ) ; 
        // session for 
        Router::redirect("/posts/$id") ; 
    }

    public function delete ($id) {
        $user = Auth::user()->id ; 
        // if(!$user) {
        // }
        $post = SavedPost::find($id)->id ; 
        // if(!$post) {
        // }
        SavedPost::deletePost($user , $post) ;         
        Router::redirect("/dashboard") ; 
    }   
}