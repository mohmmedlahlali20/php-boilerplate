<?php

namespace App\Application\Repositories;

use App\Core\Interfaces\RepositoryInterface;
use App\Infrastructure\Database;
use ReflectionClass;
use PDO;
use Exception;

/**
 * Class BaseRepository
 * Provides a generic, fluent interface for database operations.
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
    public function __construct(PDO $db = null)
    {
        // Establish database connection or use injected one
        $this->db = $db ?? Database::getInstance()->getConnection();

        // Reflection logic to extract "User" from "UserRepository"
        $reflection = new ReflectionClass($this);
        $className = $reflection->getShortName();
        $namespace = $reflection->getNamespaceName();
        
        $modelName = str_replace('Repository', '', $className);

        // Determine Model Namespace (Modular vs Core)
        if (strpos($namespace, 'App\Modules') === 0) {
            // e.g. App\Modules\Ecommerce\Repositories -> App\Modules\Ecommerce\Models
            $moduleNamespace = substr($namespace, 0, strrpos($namespace, '\\'));
            $this->modelClass = $moduleNamespace . "\\Models\\" . $modelName;
        } else {
            // Default core namespace
            $this->modelClass = "App\\Domain\\Models\\" . $modelName;
        }

        // Sets pluralized table name if not explicitly set
        if (!$this->tableName) {
            $this->tableName  = strtolower($modelName) . 's';
        }
    }

    // --- Core CRUD Operations ---

    public function all(): array
    {
        $stmt = $this->query("SELECT * FROM " . $this->tableName);
        return array_map([$this, 'mapToModel'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function find(int $id)
    {
        return $this->where('id', $id)->first();
    }

    public function unique(string $column, $value)
    {
        return $this->where($column, $value)->first();
    }   

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

        return (string) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $model = new $this->modelClass();

        if (isset($model->fillable)) {
            $data = array_intersect_key($data, array_flip($model->fillable));
        }

        $fields = array_map(fn($key) => "$key = :$key", array_keys($data));
        $sql = "UPDATE {$this->tableName} SET " . implode(', ', $fields) . " WHERE id = :id";

        $data['id'] = $id;
        return $this->query($sql, $data)->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        return $this->query("DELETE FROM {$this->tableName} WHERE id = :id", ['id' => $id])->rowCount() > 0;
    }


    public function updateOrCreate(array $attributes, array $values): self
    {
        $model = new $this->modelClass();

        if (isset($model->fillable)) {
            $values = array_intersect_key($values, array_flip($model->fillable));
        }

        $fields = array_map(fn($key) => "$key = :$key", array_keys($values));
        $sql = "UPDATE {$this->tableName} SET " . implode(', ', $fields) . " WHERE id = :id";

        $values['id'] = $id;
        return $this->query($sql, $values)->rowCount() > 0;
    }
    
    // --- Query Builder Logic ---

    public function where(string $column, $value, string $operator = '='): self
    {
        $this->wheres[] = "$column $operator :$column";
        $this->params[$column] = $value;
        return $this;
    }

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

    protected function query(string $sql, array $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    protected function resetQuery(): void
    {
        $this->wheres = [];
        $this->params = [];
    }
}
