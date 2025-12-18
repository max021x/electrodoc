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


    public static function getRecent(int $limit)
    {       
        $db = App::get('database') ; 
        return $db->fetchAll(
            "SELECT * FROM " . static::$table . " ORDER BY created_at LIMIT ? " , [$limit] , 
            static::class
        )  ;
    }
}
