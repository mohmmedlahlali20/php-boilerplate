<?php

namespace App\Core\Interfaces;

interface RepositoryInterface
{
    public function all();
    public function find(int $id);
    public function create(array $data);
}
