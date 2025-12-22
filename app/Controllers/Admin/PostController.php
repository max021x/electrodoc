<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Services\Authorization;
use Core\Viewer;
use Core\Router ; 


class PostController
{

    public function index()
    {
        Authorization::verify('dashboard');
        $posts = Post::all();
        return Viewer::render('admin/posts/index', ['active' => 'posts', 'posts' => $posts], 'admin/layouts/main');
    }

    public function create()
    {
        return Viewer::render('admin/posts/create', ['active' => 'create'], 'admin/layouts/main');
    }

    public function store() {}

    public function show($id)
    {
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

    public function delete($id) {
        $post = Post::find($id)  ;
        // if(!$post) {
            // view with the error of undefined id
        // }   
        $post->delete($id);
        Router::redirect('/admin/posts') ; 
    }
}
