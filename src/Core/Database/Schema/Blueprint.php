<?php

namespace App\Core\Database\Schema;

/**
 * Class Blueprint
 * Handles the definition of table columns and constraints for database migrations.
 * Supports method chaining for a fluent interface.
 */
class Blueprint
{
    /** @var array Holds the SQL string fragments for each column */
    private array $columns = [];

    /**
     * Define an auto-incrementing integer primary key.
     * @return $this
     */
    public function id()
    {
        $this->columns[] = "id INT AUTO_INCREMENT PRIMARY KEY";
        return $this;
    }

    /**
     * Define a variable-length string column.
     * @param string $name
     * @param int $length
     * @return $this
     */
    public function string($name, $length = 255)
    {
        $this->columns[] = "$name VARCHAR($length) NOT NULL";
        return $this;
    }

    /**
     * Define a long text column.
     * @param string $name
     * @return $this
     */
    public function text($name)
    {
        $this->columns[] = "$name TEXT NOT NULL";
        return $this;
    }

    /**
     * Define an integer column.
     * @param string $name
     * @return $this
     */
    public function integer($name)
    {
        $this->columns[] = "$name INT NOT NULL";
        return $this;
    }

    /**
     * Allow the last defined column to accept NULL values.
     * @return $this
     */
    public function nullable()
    {
        $lastIndex = count($this->columns) - 1;
        if ($lastIndex >= 0) {
            $this->columns[$lastIndex] = str_replace("NOT NULL", "NULL", $this->columns[$lastIndex]);
        }
        return $this;
    }

    /**
     * Set a default value for the last defined column.
     * @param mixed $value
     * @return $this
     */
    public function default($value)
    {
        $lastIndex = count($this->columns) - 1;
        if ($lastIndex >= 0) {
            $formattedValue = is_string($value) ? "'$value'" : $value;
            $this->columns[$lastIndex] .= " DEFAULT $formattedValue";
        }
        return $this;
    }

    /**
     * Add a 'deleted_at' timestamp for soft delete functionality.
     * @return $this
     */
    public function softDeletes()
    {
        $this->columns[] = "deleted_at TIMESTAMP NULL DEFAULT NULL";
        return $this;
    }

    /**
     * Add 'created_at' and 'updated_at' timestamp columns.
     * @return $this
     */
    public function timestamps()
    {
        $this->columns[] = "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        return $this;
    }

    /**
     * Compile the column definitions into a single SQL string fragment.
     * @return string
     */
    public function getSql()
    {
        return implode(", ", $this->columns);
    }
}