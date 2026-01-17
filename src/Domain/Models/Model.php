<?php

namespace App\Domain\Models;

use App\Core\Bootstrap\Bootstrap;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Bootstrap::initDatabase();
    }
}