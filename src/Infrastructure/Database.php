<?php

declare(strict_types=1);

namespace App\Infrastructure;

use PDO;
use PDOException;
use App\Core\Exceptions\FrameworkException;

/**
 * Class Database
 * Refactored to use the centralized Config system for connection parameters.
 */
class Database 
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct() 
    {
        $config = config('database.connections.' . config('database.default', 'mysql'));
        
        if (!$config) {
            throw new FrameworkException("Database configuration not found for the default connection.");
        }

        $driver = config('database.default', 'mysql');
        $host   = $config['host'] ?? '127.0.0.1';
        $db     = $config['database'] ?? '';
        $user   = $config['username'] ?? 'root';
        $pass   = $config['password'] ?? '';
        $port   = $config['port'] ?? '3306';

        switch ($driver) {
            case 'sqlite':
                $dsn = "sqlite:" . \App\Core\Bootstrap\Bootstrap::getBasePath() . "/storage/database.sqlite";
                break;
            case 'mysql':
            default:
                $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
                break;
        }

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new FrameworkException("Database Connection Failed: " . $e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    public static function getInstance(): self 
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO 
    {
        return $this->connection;
    }

    private function __clone() {}

    public function __wakeup() 
    {
        throw new FrameworkException("Cannot unserialize a singleton.");
    }
}