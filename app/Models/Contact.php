<?php

namespace App\Models;

use Core\Model;
use Core\App;

class Contact extends Model
{

    protected static string $table = 'contactmessages';
    public $id;
    public $name;
    public $email;
    public $message;
    public $ip;
    public $created_at;


    public static function getRecent(?int $limit = null, ?int $page = null, ?string $search = null)
    {

        $sql = "SELECT * FROM " . static::$table;
        $params = [];

        if ($search !== null) {
            $sql .= " WHERE name LIKE ? OR message LIKE ? OR email LIKE ?";
            $params = ["%$search%", "%$search%" , "%$search%"];
        }

        $sql .= " ORDER BY created_at DESC";

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
