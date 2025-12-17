<?php

namespace App\Controller\Admin;

use Core\Viewer;


class DashboardController
{

    public function index()
    {
        return Viewer::render('admin/dashboard', [], 'admin/layouts/main');
    }
    // show all posts
    public function posts()
    {
        // select * posts  ; 
        return Viewer::render('admin/adminPosts', [], 'admin/layouts/main');
    }
    // create post from
    public function create() {
        // show from here
        return Viewer::render('admin/adminCreate' , [] , 'admin/layouts/main') ; 
    }
    // store post
    public function store() {}
    // show specific post
    public function show($id) {}
    // shoe post to edit 
    public function edit($id) {}
    // update post
    public function update($id) {}
    // delete post
    public function delete($id) {}
}
