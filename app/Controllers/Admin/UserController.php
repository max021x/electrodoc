<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Authorization;
use Core\Router;
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
        $users = User::getRecent(page: $page, limit: $limit, search: $search, role: $role);
        $total = User::count();
        return Viewer::render(
            'admin/user/index',
            [
                'users' => $users,
                'currentPage' => $page,
                'totalPages' => ceil($total / $limit)
            ],
            'admin/layouts/main'
        );
    }

    public function create()
    {
        Authorization::verify('dashboard');
        return Viewer::render(
            'admin/user/create',
            [],
            'admin/layouts/main'
        );
    }

    public function store()
    {
        Authorization::verify('dashboard');
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = $_POST['role'];
        $status = $_POST['status'];



        if (User::findByEmail($email)) {
            return Viewer::render(
                'admin/user/create',
                ['error' => 'This email is already registered. Please use a different email address .'],
                'admin/layouts/main'
            );
        }

        if ($password !== $confirm_password) {
            return Viewer::render(
                'admin/user/create',
                ['error' => 'Passwords do not match.'],
                'admin/layouts/main'
            );
        }

        User::create(
            [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role,
                'status' => $status
            ]
        );

        Router::redirect('/admin/users');
    }

    public function edit() {}

    public function update() {}

    public function delete() {}
}
