<?php

namespace App\Core\Database\Schema;

/**
 * Class Blueprint
 * Handles the definition of table columns and constraints for database migrations.
 * Supports method chaining for a fluent interface.
 */
class Blueprint
{
    private array $columns = [];
    private array $commands = [];
    private string $engine = 'InnoDB';
    private string $charset = 'utf8mb4';
    private string $collation = 'utf8mb4_unicode_ci';

    /**
     * Define an auto-incrementing integer primary key.
     * @return $this
     */
    public function id()
    {
        return $this->integer('id')->autoIncrement()->primary();
    }

    /**
     * Define a variable-length string column.
     * @param string $name
     * @param int $length
     * @return $this
     */
    public function string($name, $length = 255)
    {
        $this->columns[] = [
            'type' => 'VARCHAR',
            'name' => $name,
            'length' => $length,
            'nullable' => false,
            'default' => null,
            'unique' => false,
            'primary' => false,
            'auto_increment' => false,
            'unsigned' => false
        ];
        return $this;
    }

    /**
     * Define a long text column.
     */
    public function text($name)
    {
        $this->columns[] = [
            'type' => 'TEXT',
            'name' => $name,
            'nullable' => false
        ];
        return $this;
    }

    /**
     * Define an integer column.
     */
    public function integer($name)
    {
        $this->columns[] = [
            'type' => 'INT',
            'name' => $name,
            'nullable' => false,
            'unsigned' => false,
            'auto_increment' => false
        ];
        return $this;
    }

    /**
     * Define a big integer column.
     */
    public function bigInteger($name)
    {
        $this->columns[] = [
            'type' => 'BIGINT',
            'name' => $name,
            'nullable' => false,
            'unsigned' => false
        ];
        return $this;
    }

    /**
     * Define a boolean column.
     */
    public function boolean($name)
    {
        $this->columns[] = [
            'type' => 'TINYINT',
            'name' => $name,
            'length' => 1,
            'nullable' => false
        ];
        return $this;
    }

    /**
     * Define an enum column.
     */
    public function enum($name, array $allowed)
    {
        $values = "'" . implode("', '", $allowed) . "'";
        $this->columns[] = [
            'type' => "ENUM($values)",
            'name' => $name,
            'nullable' => false
        ];
        return $this;
    }

    /**
     * Define a decimal column.
     */
    public function decimal($name, $precision = 8, $scale = 2)
    {
        $this->columns[] = [
            'type' => "DECIMAL($precision, $scale)",
            'name' => $name,
            'nullable' => false
        ];
        return $this;
    }

    /**
     * Define a timestamp column.
     */
    public function timestamp($name)
    {
        $this->columns[] = [
            'type' => 'TIMESTAMP',
            'name' => $name,
            'nullable' => true
        ];
        return $this;
    }

    /**
     * Define a date column.
     */
    public function date($name)
    {
        $this->columns[] = [
            'type' => 'DATE',
            'name' => $name,
            'nullable' => false
        ];
        return $this;
    }

    /**
     * Add 'created_at' and 'updated_at' columns.
     */
    public function timestamps()
    {
        $this->columns[] = [
            'type' => 'TIMESTAMP',
            'name' => 'created_at',
            'default' => 'CURRENT_TIMESTAMP',
            'nullable' => true
        ];
        $this->columns[] = [
            'type' => 'TIMESTAMP',
            'name' => 'updated_at',
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'nullable' => true
        ];
        return $this;
    }

    /**
     * Add 'deleted_at' for soft deletes.
     */
    public function softDeletes()
    {
        $this->columns[] = [
            'type' => 'TIMESTAMP',
            'name' => 'deleted_at',
            'nullable' => true
        ];
        return $this;
    }

    /**
     * Define a foreign key column.
     */
    public function foreignId($name)
    {
        return $this->bigInteger($name)->unsigned();
    }

    // --- Modifiers ---

    public function nullable()
    {
        $this->lastColumn()['nullable'] = true;
        return $this;
    }

    public function default($value)
    {
        $this->lastColumn()['default'] = $value;
        return $this;
    }

    public function unsigned()
    {
        $this->lastColumn()['unsigned'] = true;
        return $this;
    }

    public function unique()
    {
        $this->lastColumn()['unique'] = true;
        return $this;
    }

    public function primary()
    {
        $this->lastColumn()['primary'] = true;
        return $this;
    }

    public function autoIncrement()
    {
        $this->lastColumn()['auto_increment'] = true;
        return $this;
    }

    /**
     * Define a foreign key constraint.
     */
    public function constrained($table, $column = 'id')
    {
        $lastCol = $this->lastColumn();
        $this->commands[] = [
            'type' => 'foreign',
            'column' => $lastCol['name'],
            'references' => $column,
            'on' => $table
        ];
        return $this;
    }

    public function onDelete($action)
    {
        $lastCommand = &$this->commands[count($this->commands) - 1];
        if ($lastCommand['type'] === 'foreign') {
            $lastCommand['on_delete'] = $action;
        }
        return $this;
    }

    private function &lastColumn()
    {
        return $this->columns[count($this->columns) - 1];
    }

    /**
     * Compile the SQL for creating the table.
     */
    public function getSql($table)
    {
        $sqlParts = [];
        $constraints = [];

        foreach ($this->columns as $col) {
            $part = "`{$col['name']}` {$col['type']}";
            
            if (isset($col['length'])) {
                $part = "`{$col['name']}` {$col['type']}({$col['length']})";
            }

            if (($col['unsigned'] ?? false)) $part .= " UNSIGNED";
            if (!($col['nullable'] ?? false)) $part .= " NOT NULL";
            
            if (isset($col['default'])) {
                $val = is_string($col['default']) && strpos($col['default'], 'CURRENT_TIMESTAMP') === false 
                        ? "'{$col['default']}'" 
                        : $col['default'];
                $part .= " DEFAULT $val";
            }

            if (($col['auto_increment'] ?? false)) $part .= " AUTO_INCREMENT";
            if (($col['primary'] ?? false)) $constraints[] = "PRIMARY KEY (`{$col['name']}`)";
            if (($col['unique'] ?? false)) $constraints[] = "UNIQUE KEY `{$table}_{$col['name']}_unique` (`{$col['name']}`)";

            $sqlParts[] = $part;
        }

        foreach ($this->commands as $cmd) {
            if ($cmd['type'] === 'foreign') {
                $onDelete = isset($cmd['on_delete']) ? " ON DELETE {$cmd['on_delete']}" : "";
                $constraints[] = "CONSTRAINT `{$table}_{$cmd['column']}_foreign` 
                                  FOREIGN KEY (`{$cmd['column']}`) 
                                  REFERENCES `{$cmd['on']}`(`{$cmd['references']}`)$onDelete";
            }
        }

        $allParts = array_merge($sqlParts, $constraints);
        return implode(", ", $allParts);
    }
}