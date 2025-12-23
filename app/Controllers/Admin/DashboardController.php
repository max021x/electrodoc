<?php

namespace App\Controllers\Admin;

use Core\Viewer;
use App\Services\Authorization;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\User;

class DashboardController
{

    public function index()
    {
        Authorization::verify('dashboard');

        $totalPosts = Post::count();
        $totalComments = Comment::count();
        $totalContacts = Contact::count();
        $totalUsers = User::count();
        
        return Viewer::render('admin/dashboard/index', [
            'active' => 'dashboard',
            'totalPosts' => $totalPosts,
            'totalComments' => $totalComments , 
            'totalContacts' => $totalContacts , 
            'totalUsers' => $totalUsers
        ], 'admin/layouts/main');
    }
}
