<?php

namespace App\Core\Database\Schema;

class Blueprint
{
    private array $columns = [];

    // K-n-re-turn-iw $this bach n-9dro n-zido nullable() aw default() f l-akhir
    public function id()
    {
        $this->columns[] = "id INT AUTO_INCREMENT PRIMARY KEY";
        return $this;
    }

    public function string($name, $length = 255)
    {
        $this->columns[] = "$name VARCHAR($length) NOT NULL";
        return $this;
    }

    public function text($name)
    {
        $this->columns[] = "$name TEXT NOT NULL";
        return $this;
    }

    public function integer($name)
    {
        $this->columns[] = "$name INT NOT NULL";
        return $this;
    }

    public function nullable()
    {
        $lastIndex = count($this->columns) - 1;
        if ($lastIndex >= 0) {
            $this->columns[$lastIndex] = str_replace("NOT NULL", "NULL", $this->columns[$lastIndex]);
        }
        return $this;
    }

    public function default($value)
    {
        $lastIndex = count($this->columns) - 1;
        if ($lastIndex >= 0) {
            $formattedValue = is_string($value) ? "'$value'" : $value;
            $this->columns[$lastIndex] .= " DEFAULT $formattedValue";
        }
        return $this;
    }


    public function softDeletes()
    {
        $this->columns[] = "deleted_at TIMESTAMP NULL DEFAULT NULL";
        return $this;
    }

    public function timestamps()
    {
        $this->columns[] = "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        return $this;
    }

    public function getSql()
    {
        return implode(", ", $this->columns);
    }
}
