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
        $page = $_GET['page'] ?? 1;
        $limit = 1;
        $posts = Post::getRecent(limit: $limit, page: $page);
        $total = Post::count();

        return Viewer::render(
            'admin/posts/index',
            [
                'active' => 'posts',
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

        $fileName = "";

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $file = $_FILES['image'];
            $fileType = $file['type'];

            if (!in_array($fileType, ['image/png', 'image/jpeg'])) {
                var_dump($fileType);
                exit("Error File Type");
            }

            if ($file['size'] > 2 * 1024 * 1024) {
                exit("Error File Size");
            }

            $uploadDir = __DIR__ . '/../../../public/uploads/posts/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('post_', true) . '.' . $extension;
            $destination = $uploadDir . $fileName;

            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                exit("Error Did not Move");
            }

        }
                
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'], 
            'image' => $fileName , 
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
        Authorization::verify('delete_post' , $post);
        // if(!$post) {
        // view with the error of undefined id
        // }   
        $post->delete($id);
        Router::redirect('/admin/posts');
    }
}
