<?php

namespace App\Models;

use Core\Model;

class Post extends Model
{
    protected static string $table = 'posts' ; 
    public $id;
    public $title;
    public $content;
    public $views;
    public $category_id;
    public $user_id;
    public $created_at;
    public $updated_at;
}
