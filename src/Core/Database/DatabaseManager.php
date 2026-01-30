<?php

namespace App\Core\Database;

use PDO;

class DatabaseManager
{
    protected PDO $pdo;
    private static ?DatabaseManager $instance = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function setInstance(DatabaseManager $instance): void
    {
        self::$instance = $instance;
    }

    public static function getInstance(): ?DatabaseManager
    {
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    public function table(string $table): QueryBuilder
    {
        // For general DB::table, we might not have a model class.
        // We can use a generic StdClass or a dedicated DataObject.
        return new QueryBuilder($table, \stdClass::class);
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }

    public function __call($method, $args)
    {
        return $this->pdo->$method(...$args);
    }
}
