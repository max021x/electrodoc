<?php

namespace Core;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Database
{

    protected $pdo;

    public function __construct(array $config)
    {
        try {
            $dsn = $this->createDsn($config);
            $username = $config['username'] ?? null;
            $password = $config['password'] ?? null;
            $options = $config['options'] ?? null;

            $this->pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            throw new Exception("Could not connect to the Database ");
        }
    }

    private function createDsn(array $config): string
    {
        $driver = $config['driver'];
        $dbname = $config['dbname'];

        return match ($driver) {
            'sqlite' => "sqlite:$dbname",
            'mysql' => "mysql:host=localhost;port=3306;dbname=$dbname;charset=utf8",
            default => throw new Exception("Unsupported database driver : $driver")
        };
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll(string $sql, array $params = [], ?string $classname = null): array
    {
        $stmt = $this->query($sql, $params);
        return $classname ? $stmt->fetchAll(PDO::FETCH_CLASS, $classname) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(string $sql, array $params = [], ?string $classname = null): mixed
    {
        $stmt = $this->query($sql, $params); 
        $stmt->setFetchMode($classname ? PDO::FETCH_CLASS : PDO::FETCH_ASSOC , $classname);
        return $stmt->fetch() ; 
    }

    public function lastInsertId(): string|false
    {
        return $this->pdo->lastInsertId();
    }
}
