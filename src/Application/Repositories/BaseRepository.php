<?php 

namespace App\Application\Repositories;

use App\Core\Interfaces\RepositoryInterface;
use App\Infrastructure\Database;

abstract class BaseRepository implements RepositoryInterface {
    protected $db;
    protected $table;

    public function __construct(Database $db) {
        $this->db = $db;
    }
}