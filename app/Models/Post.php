<?php

namespace App\Models;

use Core\App;
use Core\Model;

class Post extends Model
{
    protected static string $table = 'posts';
    public $id;
    public $title;
    public $content;
    public $views;
    public $category_id;
    public $user_id;
    public $created_at;
    public $updated_at;


    public static function getRecent(?int $limit = null, ?int $page = null)
    {

        $sql = "SELECT * FROM " . static::$table;
        $params = [];

        if ($limit !== null) {
            $sql .= " LIMIT ?";
            $params[] = $limit;
        }

        if ($page !== null && $limit !== null) {
            $offset = ($page - 1) * $limit;
            $sql .= " OFFSET ?";
            $params[] = $offset;
        }

        $db = App::get('database');
        return $db->fetchAll(
            $sql,
            $params,
            static::class
        );
    }

    public static function count()
    {
        $db = App::get('database');
        $sql = "SELECT count(*) FROM " . static::$table;
        return (int) $db->query($sql, [])->fetchColumn();
    }
}
