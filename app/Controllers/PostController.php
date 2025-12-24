<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Core\Router;
use Core\Viewer;

class PostController
{

    public function index()
    {
        $page = $_GET['page'];
        $limit = 2;
        $posts = Post::getRecent(limit: $limit, page: $page);
        $total = Post::count();

        return Viewer::render(
            'posts/index',
            ['posts' => $posts  , 'currentPage' => $page , 'totalPages' => $total],
            'layouts/main'
        );
    }

    public function show($id)
    {

        $post = Post::find($id);
        $username = User::find($post->user_id)->name;
        // var_dump($username) ; die ; 
        if (!$post) {
            Router::notFound();
        }

        $comments = Comment::forPost($id);

        // username for each comments
        // foreach ($comments as $comment) {
        //     $name = User::find($comment->user_id)->name;
        //     $comment->user_id = $name ; 
        // }

        return Viewer::render('posts/show', ['post' => $post, 'author_name' => $username, 'comments' => $comments], 'layouts/main');
    }
}
