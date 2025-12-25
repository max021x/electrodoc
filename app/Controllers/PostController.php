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
        $limit = 12;
        $posts = Post::getRecent(limit: $limit, page: $page);
        $total = Post::count();

        return Viewer::render(
            'posts/index',
            ['posts' => $posts, 'currentPage' => $page, 'totalPages' => ceil($total / $limit)],
            'layouts/main'
        );
    }

    public function show($id)
    {

        $post = Post::find($id);

        if (!$post) {
            Router::notFound();
        }

        Post::incrementViews($id) ; 

        $username = User::find($post->user_id)->name;
        $comments = Comment::forPost($id);

        return Viewer::render('posts/show', [
            'post' => $post,
            'author_name' => $username,
            'comments' => $comments
        ], 'layouts/main');
    }
}
