<?php

namespace App\Core\Database;

use PDO;
use ReflectionClass;

/**
 * Class Model
 * Base Active Record class for Laravel-like database interactions.
 */
abstract class Model
{
    protected static ?PDO $db = null;
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $fillable = [];
    protected array $attributes = [];
    
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
        if (!isset($this->table)) {
            $this->table = strtolower((new ReflectionClass($this))->getShortName()) . 's';
        }
    }

    public static function setConnection(PDO $db): void
    {
        self::$db = $db;
    }

    public static function getConnection(): ?PDO
    {
        return self::$db;
    }

    public static function find($id): ?static
    {
        $instance = new static();
        $stmt = self::$db->prepare("SELECT * FROM {$instance->table} WHERE {$instance->primaryKey} = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? new static($result) : null;
    }

    public static function all(): array
    {
        $instance = new static();
        $stmt = self::$db->query("SELECT * FROM {$instance->table}");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new static($row), $results);
    }

    public static function where(string $column, $value, string $operator = '='): QueryBuilder
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, static::class))->where($column, $value, $operator);
    }

    public function save(): bool
    {
        if (isset($this->attributes[$this->primaryKey])) {
            return $this->update();
        }
        return $this->insert();
    }

    protected function insert(): bool
    {
        $data = $this->getFillableData();
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = self::$db->prepare($sql);
        $result = $stmt->execute($data);
        
        if ($result) {
            $this->attributes[$this->primaryKey] = self::$db->lastInsertId();
        }
        
        return $result;
    }

    protected function update(): bool
    {
        $data = $this->getFillableData();
        $fields = array_map(fn($key) => "$key = :$key", array_keys($data));
        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE {$this->primaryKey} = :pk_id";
        
        $data['pk_id'] = $this->attributes[$this->primaryKey];
        $stmt = self::$db->prepare($sql);
        return $stmt->execute($data);
    }

    protected function getFillableData(): array
    {
        if (empty($this->fillable)) {
            return $this->attributes;
        }
        return array_intersect_key($this->attributes, array_flip($this->fillable));
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
