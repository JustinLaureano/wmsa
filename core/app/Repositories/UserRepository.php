<?php

namespace App\Repositories;

use App\Domain\Auth\DataTransferObjects\AssignUserRoleData;
use App\Models\User;

class UserRepository
{
    /**
     * Assign a role for the user.
     */
    public function assignRole(AssignUserRoleData $data) : void
    {
        $data->user->assignRole($data->role);
    }

    /**
     * Find a user record by a given column name.
     */
    public function findBy(string $column, string $value) : User|null
    {
        return User::query()->where($column, $value)->first();
    }

    /**
     * Find a user record for a teammate by the given first and last name.
     */
    public function findForTeammate(string $firstName, string $lastName) : User|null
    {
        return User::query()->whereName($firstName, $lastName)->first();
    }
}
