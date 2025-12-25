<?php

namespace App\Models;

use Core\App;
use Core\Model;
use App\Models\PostViews;

class Post extends Model
{
    protected static string $table = 'posts';
    public $id;
    public $title;
    public $content;
    public $image;
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

    public static function incrementViews($id)
    {
        $db = App::get('database');
        $ip = $_SERVER['REMOTE_ADDR'];

        $storedIp  = $db->fetchAll(
            "SELECT * FROM post_views" . " WHERE post_id = ? AND ip_address = ?",
            [$id, $ip],
            PostViews::class
        );

        if (!$storedIp) {
            PostViews::create(
                ['post_id' => $id, 'ip_address' => $ip]
            );

            $db->query(
                "UPDATE posts SET views = views + 1 WHERE id = ?",
                [$id]
            );
        }

    }
}
