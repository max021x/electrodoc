<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Services\Authorization;
use Core\Viewer;


class PostController
{

    public function index()
    {   
        Authorization::verify('dashboard') ; 
        $posts = Post::all() ;
        return Viewer::render('admin/posts/index', ['active' => 'posts' , 'posts' => $posts], 'admin/layouts/main');
    }

    public function create() {
        return Viewer::render('admin/posts/create' , ['active' => 'create'] , 'admin/layouts/main') ; 
    }
    
    public function store() {}

    public function show($id) {
        $post = Post::find($id) ; 
        Authorization::verify('dashboard') ; 
        return Viewer::render('admin/posts/show' , ['posts' => $post] , 'admin/layouts/main') ; 
    }

    public function edit($id) {}

    public function update($id) {}

    public function delete($id) {}
}
