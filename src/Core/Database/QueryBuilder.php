<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    protected string $table;
    protected string $modelClass;
    protected array $wheres = [];
    protected array $params = [];
    protected ?int $limit = null;
    protected array $orderBy = [];

    protected ?int $cacheTtl = null;

    public function __construct(string $table, string $modelClass)
    {
        $this->table = $table;
        $this->modelClass = $modelClass;
    }

    public function remember(int $seconds): self
    {
        $this->cacheTtl = $seconds;
        return $this;
    }

    public function where(string $column, $value, string $operator = '='): self
    {
        $placeholder = str_replace('.', '_', $column) . '_' . count($this->params);
        $this->wheres[] = "$column $operator :$placeholder";
        $this->params[$placeholder] = $value;
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function get(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }

        if (!empty($this->orderBy)) {
            $sql .= " ORDER BY " . implode(', ', $this->orderBy);
        }

        if ($this->limit) {
            $sql .= " LIMIT {$this->limit}";
        }

        if ($this->cacheTtl !== null) {
            $cacheKey = 'query_' . md5($sql . serialize($this->params));
            if ($cached = \App\Core\Support\Cache::get($cacheKey)) {
                return array_map(fn($data) => new $this->modelClass($data), $cached);
            }
        }

        $db = DatabaseManager::getInstance()->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute($this->params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($this->cacheTtl !== null) {
            \App\Core\Support\Cache::set($cacheKey, $results, $this->cacheTtl);
        }

        return array_map(fn($row) => new $this->modelClass($row), $results);
    }

    public function first(): ?Model
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }
}
