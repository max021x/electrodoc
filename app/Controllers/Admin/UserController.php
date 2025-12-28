<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Auth;
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
                'active' => 'users' , 
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
            ['active' => 'create_user'],
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

    public function edit($id)
    {
        $user = User::find($id);
        return Viewer::render(
            'admin/user/edit',
            ['user' => $user],
            'admin/layouts/main'
        );
    }

    public function update($id)
    {
        $user = User::find($id);
        Authorization::verify('edit_user' , $user);

        if (!$user) {
            return Viewer::render(
                'admin/user/edit',
                ['error' => 'User not Found'],
                'admin/layouts/main'
            );
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if (!empty($email) && User::findByEmail($email) === false || $user->email === $email) {
            $user->email = $email;
        } else {
            $_SESSION['error'] = "This email is already registered. Please use a different email address .";
            Router::redirect("/admin/users/$id/edit");
        }

        if (!empty($name) || !empty($role) || !empty($status)) {
            $user->name = $name;
            $user->role = $role;
            $user->status = (int) $status;
        }

        if (!empty($password) || !empty($confirm_password)) {
            if ($password === $confirm_password) {
                $user->password = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $_SESSION['error'] = "Password Do Not Match";
                Router::redirect("/admin/users/$id/edit");
            }
        }

        $user->save();
        Router::redirect('/admin/users');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return Viewer::render(
                'admin/user/edit',
                ['error' => 'User not Found'],
                'admin/layouts/main'
            );
        }
        if ($user->id === Auth::user()->id) {
            Auth::logout();
            $user->delete();
            Router::redirect('/login');
        }
        $user->delete();
        Router::redirect('/admin/users');
    }
}
