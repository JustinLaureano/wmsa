<?php

namespace App\Repositories;

use App\Domain\Auth\DataTransferObjects\AssignUserRoleData;
use App\Domain\Auth\DataTransferObjects\RemoveUserRoleData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
     * Retrieve all user records.
     */
    public function get(array|string|null $with = null) : Collection
    {
        return User::query()
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->get();
    }

    /**
     * Remove a role for the user.
     */
    public function removeRole(RemoveUserRoleData $data) : void
    {
        $data->user->removeRole($data->role);
    }
}
