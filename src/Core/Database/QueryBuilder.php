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

    public function __construct(string $table, string $modelClass)
    {
        $this->table = $table;
        $this->modelClass = $modelClass;
    }

    public function where(string $column, $value, string $operator = '='): self
    {
        $this->wheres[] = "$column $operator :$column";
        $this->params[$column] = $value;
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

        $db = Model::getConnection(); // I'll need to add a getter for the connection
        $stmt = $db->prepare($sql);
        $stmt->execute($this->params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new $this->modelClass($row), $results);
    }

    public function first(): ?Model
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }
}
