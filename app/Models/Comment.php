<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected static string $table = 'comments';
    public $id;
    public $content;
    public $post_id;
    public $user_id;
    public $created_at;
    public $updated_at;
}
