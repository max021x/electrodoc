<?php

namespace App\Models;

use Core\Model;
use Core\App;

class Comment extends Model
{
    protected static string $table = 'comments';
    public $id;
    public $content;
    public $post_id;
    public $user_id;
    public $created_at;
    public $updated_at;
    public $name;

    public static function forPost($id)
    {
        $db = App::get('database');
        $sql = "SELECT comments.* , users.name FROM " . static::$table .
            " INNER JOIN users ON comments.user_id = users.id " .
            " WHERE comments.post_id = ?" .
            " ORDER BY comments.created_at ASC";
        return $db->fetchAll($sql, [$id], static::class);
    }

    public static function count()
    {
        $db = App::get('database');
        $sql = "SELECT count(*) FROM " . static::$table;
        return (int) $db->query($sql, [])->fetchColumn();
    }
}
