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
        $page = $_GET['page'] ?? 1 ; 
        $category = $_GET['category'] ?? null ; 
        $limit = 12;
        $posts = Post::getRecent(category:$category , limit: $limit, page:$page);
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
            $fileName  = Post::imageHandler($_FILES['image']);
            if($fileName === false) {
                Router::redirect('/admin/posts/create') ; 
            }   
        }

        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'image' => $fileName,
            'user_id' => Auth::user()->id,
            'category' => $_POST['category']
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

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $remove_image = $_POST['remove_image'] ?? false;

        if (!empty($title) || !empty($content) || !empty($category)) {
            $post->title = $title;
            $post->content = $content;
            $post->category = $category;
        }

        $fileName = "";
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName  = Post::imageHandler($_FILES['image']);
            if (!empty($post->image)) {
                $oldImagePath = __DIR__ . '/../../../public/uploads/posts/' . basename($post->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $post->image = $fileName;
        }

        if ($remove_image) {
            if (!empty($post->image)) {
                $imagePath = __DIR__ . '/../../../public/uploads/posts/' . basename($post->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    $post->image = null;
                }
            }
        }

        $post->save();
        Router::redirect('/admin/posts');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        Authorization::verify('delete_post', $post);
        if (!empty($post->image)) {
            $oldImagePath = __DIR__ . '/../../../public/uploads/posts/' . basename($post->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $post->delete($id);
        Router::redirect('/admin/posts');
    }
}
