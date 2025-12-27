<?php


namespace App\Models;

use Core\App;
use Core\Model;

class User extends Model
{

    protected static string $table = 'users';
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $status; 
    public $created_at;

    public static function findByEmail(string $email)
    {
        $db = App::get('database');
        $result = $db->fetch(
            "SELECT * FROM users WHERE email = ?",
            [$email],
            static::class
        );
        return $result ? $result : null;
    }

    public static function count()
    {
        $db = App::get('database');
        $sql = "SELECT count(*) FROM " . static::$table ;
        return (int) $db->query($sql, [])->fetchColumn();
    }


    public static function getRecent(?int $limit = null, ?int $page = null, ?string $search = null, ?string $role = null)
    {

        $sql = "SELECT * FROM " . static::$table;
        $params = [];

        if ($role !== null) {
            $sql .= " WHERE role LIKE ?";
            $params = ["%$role%"];
        }

        if ($search !== null) {
            $sql .= " WHERE name LIKE ? OR email LIKE ?";
            $params = ["%$search%", "%$search%"];
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
}
