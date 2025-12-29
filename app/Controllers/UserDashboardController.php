<?php


namespace App\Controllers;

use App\Models\Post;
use App\Models\SavedPost;
use App\Models\User;
use App\Services\Auth;
use Core\Router;
use Core\Viewer;

class UserDashboardController
{

    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $limit = 12;
        $posts = SavedPost::getRecent(limit: $limit, page: $page);
        return Viewer::render('user/index', ['savedPosts' => $posts], 'layouts/main');
    }

    public function update()
    {

        $user = Auth::user();
        // if(!$user) {

        // }

        $email = $_POST['email'];
        $confirm_password = $_POST['confirm_password'];

        if (!User::findByEmail($email) || $user->email === $email) {
            if (!empty($email) && !empty($confirm_password) && password_verify($confirm_password, $user->password)) {
                // session success
                $user->email = $email;
            } else {
                $_SESSION['error'] = "Invalid Credentials Check all fields again :(";
                Router::redirect("/dashboard");
            }
        } else {
            $_SESSION['error'] = "This email is already registered. Please use a different email address .";
            Router::redirect("/dashboard");
        }



        $user->save();
        Router::redirect('/dashboard');
    }


    public function change()
    {

        $current_password = $_POST['current_password'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $user = Auth::user();
        // if(!$user) {

        // }

        if (!empty($current_password) && !empty($password) && !empty($confirm_password) && password_verify($current_password, $user->password)) {
            if ($password === $confirm_password) {
                $user->password = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $_SESSION['error'] = "Passwords Do No Match";
                Router::redirect("/dashboard");
            }
        } else {
            $_SESSION['error'] = "Invalid Credentials Check all fields again :(";
            Router::redirect("/dashboard");
        }
        $user->save();
        Router::redirect("/dashboard");
    }

    public function save($id)
    {
        // if(!Post::find($id)){
        // }

        $user = Auth::user()->id;

        if (SavedPost::isSaved($user, $id)) {
            $_SESSION['error'] = 'Sorry you have already saved this post before';
            Router::redirect("/posts/$id");
        }

        SavedPost::create(
            [
                'user_id' => $user,
                'post_id' => $id,
            ]
        );
        // session for 
        Router::redirect("/posts/$id");
    }

    public function delete($id)
    {
        $user = Auth::user()->id;
        // if(!$user) {
        // }
        $post = SavedPost::find($id)->id;
        // if(!$post) {
        // }
        SavedPost::deletePost($user, $post);
        Router::redirect("/dashboard");
    }

    public function deleteAccount()
    {

        $user = Auth::user();
        // if(!$user) {

        // }

        $password = $_POST['password'];

        if (!empty($password) && password_verify($password, $user->password)) {
            $user->status = 0;
            $user->save() ; 
            Auth::logout();
            Router::redirect('/') ; 
        } else {
            $_SESSION['error'] = "Invalid Credentials Check all fields again :(";
            Router::redirect("/dashboard");
        }
    }
}
