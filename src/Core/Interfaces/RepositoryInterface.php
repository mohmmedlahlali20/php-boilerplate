<?php

namespace App\Core\Interfaces;

/**
 * Interface RepositoryInterface
 * Defines the standard contract for data access across the application.
 */
interface RepositoryInterface
{
    /**
     * Retrieve all records from the storage.
     * @return array
     */
    public function all(): array;

    /**
     * Find a single record by its unique ID.
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Create a new record in the storage.
     * @param array $data
     * @return bool|int Returns success status or the new ID
     */
    public function create(array $data);

    /**
     * Update an existing record by its ID.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a record from the storage by its ID.
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}