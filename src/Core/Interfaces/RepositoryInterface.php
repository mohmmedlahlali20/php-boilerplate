<?php

namespace App\Core\Interfaces;

interface RepositoryInterface
{
    public function all();
    public function find(int $id);
    public function create(array $data);
    public function delete(int $id);
    public function update(int $id, array $data);
}
