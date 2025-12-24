<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Core\App;

require_once "bootstrap.php";

$db = App::get('database');

$db->query("DELETE FROM comments");
$db->query("DELETE FROM posts");
$db->query("DELETE FROM categories");
$db->query("DELETE FROM users");

// Reset auto-increment counters
$db->query("ALTER TABLE users AUTO_INCREMENT = 1");
$db->query("ALTER TABLE categories AUTO_INCREMENT = 1");
$db->query("ALTER TABLE posts AUTO_INCREMENT = 1");
$db->query("ALTER TABLE comments AUTO_INCREMENT = 1");

// Users
$users = [
    ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'admin'],
    ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => password_hash('password123', PASSWORD_DEFAULT), 'role' => 'user'],
    ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => password_hash('password123', PASSWORD_DEFAULT), 'role' => 'user'],
];

foreach ($users as $user) {
    User::create($user);
}

// Categories
$categories = [
    ['name' => 'Sensors'],
    ['name' => 'MicroController'],
    ['name' => 'Resistor'],
    ['name' => 'Capacitor'],
];

foreach ($categories as $category) {
    Category::create($category);
}

// Posts (make sure user_id and category_id exist in their tables)
$posts = [
    ['user_id' => 1, 'category_id' => 1, 'title' => 'Welcome to Our Blog', 'content' => 'This is our first blog post. We hope you enjoy it!'],
    ['user_id' => 2, 'category_id' => 2, 'title' => 'PHP Tips and Tricks', 'content' => 'Here are some useful PHP tips and tricks for beginners...'],
    ['user_id' => 3, 'category_id' => 3, 'title' => 'Web Development Best Practices', 'content' => 'In this post, we\'ll discuss some web development best practices...'],
];

// foreach ($posts as $post) {
//     Post::create($post);
// }

// Comments
$comments = [
    ['post_id' => 1, 'user_id' => 2, 'content' => 'Great first post! Looking forward to more.'],
    ['post_id' => 1, 'user_id' => 3, 'content' => 'Welcome to the blogosphere!'],
    ['post_id' => 2, 'user_id' => 1, 'content' => 'These are some really useful tips, thanks!'],
    ['post_id' => 3, 'user_id' => 2, 'content' => 'I\'ve been using these practices and they really help.'],
];

// foreach ($comments as $comment) {
//     Comment::create($comment);
// }

echo "Fixtures loaded successfully.\n";