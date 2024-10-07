<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Find a user record by a given column name.
     */
    public function findBy(string $column, string $value) : User|null
    {
        return User::query()->where($column, $value)->first();
    }
}
