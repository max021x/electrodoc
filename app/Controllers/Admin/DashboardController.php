<?php

namespace App\Controllers\Admin;

use Core\Viewer;
use App\Services\Authorization ; 
class DashboardController
{

    public function index()
    {
        Authorization::verify('dashboard');

        // $totalPosts = Post::count();
        // $totalComments = Comment::count();
        // $recentPosts = Post::getRecent(5);
        // $recentComments = Comment::getRecent(5);
        
        return Viewer::render('admin/dashboard/index' , [] , 'admin/layouts/main');
    }
}
