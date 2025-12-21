<?php

namespace App\Controllers\Admin;

use Core\Viewer;


class PostController
{

    public function index()
    {
        return Viewer::render('admin/dashboard', ['active' => 'dashboard'], 'admin/layouts/main');
    }

    public function create() {
        return Viewer::render('admin/adminCreate' , ['active' => 'create'] , 'admin/layouts/main') ; 
    }
    
    public function store() {}

    public function show($id) {}

    public function edit($id) {}

    public function update($id) {}

    public function delete($id) {}
}
