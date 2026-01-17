<?php

namespace App\Application\Repositories;

/**
 * Class UserRepository
 * * Handles database operations for the User model.
 * Inheritance from BaseRepository provides automated table naming ('users')
 * and model mapping (App\Domain\Models\User).
 */
class UserRepository extends BaseRepository
{
    /**
     * Retrieve all users with an active status.
     * Uses the fluent query builder from BaseRepository.
     * * @return array List of active User objects.
     */
    public function findAllActive(): array
    {
        return $this->where('status', 'active')->all();
    }

    /**
     * Example of a custom search: find a user by their email.
     * * @param string $email
     * @return \App\Domain\Models\User|null
     */
    public function findById(string $id)
    {
        return $this->where('id', $id)->first();
    }
}