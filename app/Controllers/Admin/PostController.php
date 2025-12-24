<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Services\Auth;
use App\Services\Authorization;
use Core\Viewer;
use Core\Router;


class PostController
{

    public function index()
    {
        Authorization::verify('dashboard');
        $page = $_GET['page'];
        $limit = 12;
        $posts = Post::getRecent(limit: $limit, page: $page);
        $total = Post::count();

        return Viewer::render(
            'admin/posts/index',
            [   
                'active' => 'posts' , 
                'posts' => $posts,
                'currentPage' => $page,
                'totalPages' => ceil($total / $limit)
            ],
            'admin/layouts/main'
        );
    }

    public function create()
    {
        Authorization::verify('dashboard');
        return Viewer::render('admin/posts/create', ['active' => 'create'], 'admin/layouts/main');
    }

    public function store()
    {
        Authorization::verify('dashboard');
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'user_id' => Auth::user()->id
        ];
        Post::create(
            $data
        );
        Router::redirect('/admin/posts');
    }

    public function show($id)
    {
        Authorization::verify('dashboard');
        $post = Post::find($id);
        Authorization::verify('dashboard');
        return Viewer::render('admin/posts/show', ['post' => $post], 'admin/layouts/main');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        Authorization::verify('dashboard');
        return Viewer::render('admin/posts/edit', ['post' => $post], 'admin/layouts/main');
    }

    public function update($id)
    {
        $post = Post::find($id);
        Authorization::verify('edit_post', $post);
        $post->title = $_POST['title'];
        $post->content = $_POST['title'];
        $post->save();
        Router::redirect('/admin/posts');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        Authorization::verify('dashboard');
        // if(!$post) {
        // view with the error of undefined id
        // }   
        $post->delete($id);
        Router::redirect('/admin/posts');
    }
}
