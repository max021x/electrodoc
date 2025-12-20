<?php

namespace App\Models;

use Core\Model;
use Core\App ; 

class Comment extends Model
{
    protected static string $table = 'comments';
    public $id;
    public $content;
    public $post_id;
    public $user_id;
    public $created_at;
    public $updated_at;

    public static function forPost($id)
    {
        $db = App::get('database');
        $sql = "SELECT * FROM " . static::$table .  " WHERE post_id = ?";
        return $db->fetchAll($sql, [$id] , static::class);
    }
}
