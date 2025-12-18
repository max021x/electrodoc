<?php

namespace App\Models;

use Core\Model;

class Category extends Model
{
    protected static string $table = 'categories' ; 
    public $id;
    public $name ; 
    public $created_at;
    public $updated_at;
}
