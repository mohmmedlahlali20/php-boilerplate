<?php

namespace App\Infrastructure\Migrations;
use App\Core\Bootstrap\Bootstrap;

abstract class Migration
{
    protected $db;

    public function __construct()
    {
        $this->db = Bootstrap::initDatabase();
    }

    abstract public function up();
    abstract public function down();
}