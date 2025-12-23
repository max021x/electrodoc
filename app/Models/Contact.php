<?php

namespace App\Models;

use Core\Model;
use Core\App ; 

class Contact extends Model
{

    protected static string $table = 'contactmessages';
    public $id;
    public $name;
    public $email;
    public $message;
    public $ip;
    public $created_at;

    public static function count()
    {
        $db = App::get('database');
        $sql = "SELECT count(*) FROM " . static::$table;
        return (int) $db->query($sql, [])->fetchColumn();
    }
}
