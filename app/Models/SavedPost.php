<?php

namespace App\Models;

use App\Services\Auth;
use Core\App;
use Core\Model;
use Core\Router;

class SavedPost extends Model
{

  protected static string $table = 'saved_posts';
  public $id;
  public $user_id;
  public $post_id;
  public $saved_at;

  // posts 
  public $title;
  public $content;
  public $image;
  public $views;
  public $category;
  public $created_at;
  public $updated_at;


  public static function getRecent(?string $limit, ?string $page)
  {
    $user = Auth::user()->id;
    if (!$user) {
      return [];
    }

    $sql  = "SELECT saved_posts.id  , post_id , saved_at , posts.* FROM " . static::$table;
    $sql .= " JOIN posts ON saved_posts.id = posts.id WHERE saved_posts.user_id = ? ";
    $params = [$user];

    if ($limit !== null) {
      $sql .= " LIMIT ?";
      $params[] = $limit;
    }

    if ($page !== null && $limit !== null) {
      $offset = ($page - 1) * $limit;
      $sql .= " OFFSET ?";
      $params[] =  $offset;
    }

    $db = App::get('database');
    return $db->fetchAll($sql, $params, static::class);
  }

  public static function deletePost($userId, $postId)
  {
    $db = App::get('database');
    $sql = "DELETE FROM " . static::$table . " WHERE user_id = ? AND post_id = ?";
    $params = [$userId, $postId];
    $db->query($sql, $params);
  }

  public static function isSaved($userId, $postId)
  { 

    $db= App::get('database') ; 
    $isSaved = $db->query("SELECT id FROM saved_posts WHERE user_id = ? AND post_id = ?" , [$userId , $postId]);
    if ($isSaved) {
      return true ; 
    }

    return false ; 
  }
}
