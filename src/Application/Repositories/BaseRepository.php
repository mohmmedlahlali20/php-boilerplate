<?php

namespace App\Application\Repositories;

use App\Core\Interfaces\RepositoryInterface;
use App\Infrastructure\Database;
use ReflectionClass;
use PDO;
use Exception;

/**
 * Class BaseRepository
 * * Provides a generic, fluent interface for database operations.
 * Automatically maps database rows to Domain Models using naming conventions.
 */
abstract class BaseRepository implements RepositoryInterface
{
    /** @var PDO Database connection instance */
    protected $db;

    /** @var array Holds WHERE clause strings for the query builder */
    protected $wheres = [];

    /** @var array Holds parameters for PDO prepared statements */
    protected $params = [];

    /** @var string The database table name associated with the repository */
    protected $tableName;

    /** @var string The fully qualified class name of the associated model */
    protected $modelClass;

    /**
     * BaseRepository constructor.
     * Initializes the DB connection and automatically determines tableName and modelClass.
     */
    public function __construct()
    {
        // Establish database connection
        $this->db = Database::getInstance()->getConnection();

        // Reflection logic to extract "User" from "UserRepository"
        $className = (new ReflectionClass($this))->getShortName();
        $modelName = str_replace('Repository', '', $className);

        // Sets default model path and pluralized table name
        $this->modelClass = "App\\Domain\\Models\\" . $modelName;
        $this->tableName  = strtolower($modelName) . 's';
    }

    // --- Core CRUD Operations ---

    /**
     * Retrieve all records from the table.
     * @return array List of mapped model objects.
     */
    public function all(): array
    {
        $stmt = $this->query("SELECT * FROM " . $this->tableName);
        return array_map([$this, 'mapToModel'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * Find a single record by its ID.
     * @param int $id
     * @return object|null Mapped model or null if not found.
     */
    public function find(int $id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Insert a new record into the database with mass-assignment protection.
     * @param array $data Column => Value pairs.
     * @return string The ID of the newly created record.
     */
    public function create(array $data): string
    {
        $model = new $this->modelClass();

        // Filter data using the model's $fillable property if it exists
        if (isset($model->fillable)) {
            $data = array_intersect_key($data, array_flip($model->fillable));
        }

        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->tableName} ($columns) VALUES ($placeholders)";
        $this->query($sql, $data);

        return $this->db->lastInsertId();
    }

    /**
     * Update an existing record by ID with mass-assignment protection.
     * @param int $id
     * @param array $data Column => Value updates.
     * @return bool Success status.
     */
    public function update(int $id, array $data): bool
    {
        $model = new $this->modelClass();

        // Security: Filter data using $fillable
        if (isset($model->fillable)) {
            $data = array_intersect_key($data, array_flip($model->fillable));
        }

        $fields = array_map(fn($key) => "$key = :$key", array_keys($data));
        $sql = "UPDATE {$this->tableName} SET " . implode(', ', $fields) . " WHERE id = :id";

        $data['id'] = $id;
        return $this->query($sql, $data)->rowCount() > 0;
    }

    /**
     * Delete a record by ID.
     * @param int $id
     * @return bool Success status.
     */
    public function delete(int $id): bool
    {
        return $this->query("DELETE FROM {$this->tableName} WHERE id = :id", ['id' => $id])->rowCount() > 0;
    }

    // --- Query Builder Logic ---

    /**
     * Add a WHERE condition to the query.
     * @param string $column
     * @param mixed $value
     * @param string $operator Default is '='.
     * @return $this
     */
    public function where(string $column, $value, string $operator = '='): self
    {
        $this->wheres[] = "$column $operator :$column";
        $this->params[$column] = $value;
        return $this;
    }

    /**
     * Execute the built query and return the first result.
     * @return object|null
     */
    public function first()
    {
        $sql = "SELECT * FROM {$this->tableName}";
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }
        $sql .= " LIMIT 1";

        $stmt = $this->query($sql, $this->params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->resetQuery();

        return $row ? $this->mapToModel($row) : null;
    }

    // --- Internal Helpers ---

    /**
     * Dynamically maps an associative array to a Model instance.
     * @param array $row Raw DB row.
     * @return object Model instance with properties populated.
     */
    protected function mapToModel(array $row)
    {
        if (!class_exists($this->modelClass)) {
            throw new Exception("Model class {$this->modelClass} not found.");
        }

        $model = new $this->modelClass();
        foreach ($row as $key => $value) {
            if (property_exists($model, $key)) {
                $model->$key = $value;
            }
        }
        return $model;
    }

    /**
     * Prepares and executes a SQL statement.
     * @param string $sql
     * @param array $params
     * @return \PDOStatement
     */
    protected function query(string $sql, array $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Resets query builder states to prevent pollution in subsequent calls.
     */
    protected function resetQuery(): void
    {
        $this->wheres = [];
        $this->params = [];
    }
}