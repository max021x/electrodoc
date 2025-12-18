<?php

namespace Core;

class Model
{

    protected static string $table;

    public static function all()
    {
        $db = App::get('database');
        return $db->fetchAll("SELECT * FROM " . static::$table,  [], static::class);
    }

    public static function find(mixed $id)
    {
        $db = App::get('database');
        return $db->fetch("SELECT * FROM " . static::$table . " WHERE id = ?", [$id], static::class);
    }

    public static function create(array $data)
    {
        $db = App::get('database');
        $columns = implode(', ', array_keys($data));
        $placeholder = implode(', ', array_fill(0, count($data), '?'));
        $sql  = "INSERT INTO " . static::$table . " ($columns) VALUES($placeholder)";
        $db->query($sql, array_values($data));
    }

    public static function  save()
    {

        $db = App::get('database');

        $data = get_object_vars($this);
        if (!isset($this->id)) {
            unset($data['id']);
            return static::create($data);
        }

        unset($data['id']);

        $setPart = array_map(fn($columns) => "$columns = ?", array_keys($data));
        $sql = "UPDATE " . static::$table  . " SET " . implode(', ', $setPart) . " WHERE id = ?";
        $params = array_values($data);
        $params[] = $this->id;
        $db->query($sql, $params);
        return $this;
    }

    public function delete () {
        if(!isset($this->id)) {
            return ; 
        }
        $db = App::get('database') ; 
        $sql = "DELETE FROM " . static::$table . " WHERE id = ?" ; 
        $db->quey($sql , [$this->id]); 
    }
}
