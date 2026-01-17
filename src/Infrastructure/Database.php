<?php

namespace App\Infrastructure;

use PDO;
use PDOException;
use Dotenv\Dotenv;

/**
 * Class Database
 * Manages the database connection using the Singleton Pattern to ensure 
 * only one PDO instance exists throughout the application lifecycle.
 */
class Database {
    /** @var Database|null The single instance of this class */
    private static $instance = null;

    /** @var PDO The active PDO connection */
    private $connection;

    /**
     * Private constructor to prevent direct instantiation.
     * Initializes environment variables and establishes the PDO connection based on driver.
     * @throws PDOException If the connection attempt fails.
     */
    private function __construct() {
        // Loading environment variables from the project root
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $driver = $_ENV['DATABASE']; 
        $host   = $_ENV['DB_HOST'];
        $db     = $_ENV['DB_NAME'];
        $user   = $_ENV['DB_USER'];
        $pass   = $_ENV['DB_PASS'];
        $port   = $_ENV['DB_PORT'];

        // Select DSN based on the chosen driver
        switch ($driver) {
            case 'pgsql':
                $dsn = "pgsql:host=$host;port=$port;dbname=$db";
                break;
            case 'sqlite':
                $dsn = "sqlite:" . __DIR__ . "/../../storage/database.sqlite";
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
            // Establish connection (User and Pass are ignored by SQLite)
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Retrieves the single instance of the Database class.
     * @return Database
     */
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Returns the PDO connection instance.
     * @return PDO
     */
    public function getConnection(): PDO {
        return $this->connection;
    }

    /**
     * Prevent cloning of the singleton instance.
     */
    private function __clone() {}

    /**
     * Prevent unserialization of the singleton instance.
     * @throws \Exception
     */
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}