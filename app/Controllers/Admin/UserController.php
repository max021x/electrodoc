<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Authorization;
use Core\Viewer;

class UserController
{

    public function index()
    {
        Authorization::verify('dashboard');
        $page = $_GET['page'] ?? 1;
        $search  = $_GET['search'] ?? null;
        $role  = $_GET['role'] ?? null;
        $limit = 12; 
        $users = User::getRecent(page: $page, limit: $limit, search: $search , role:$role);
        $total = User::count() ; 
        return Viewer::render(
            'admin/user/index',
            ['users' => $users, 'currentPage' => $page, 'totalPages' => ceil($total / $limit)],
            'admin/layouts/main'
        );
    }

    public function create() {}

    public function store() {}

    public function edit() {}

    public function update() {}

    public function delete() {}
}
