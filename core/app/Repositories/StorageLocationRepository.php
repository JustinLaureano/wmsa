<?php

namespace App\Repositories;

use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Collection;

class StorageLocationRepository
{
    public function findByUuid(string $uuid) : StorageLocation
    {
        return StorageLocation::query()->whereUuid($uuid)->first();
    }

    public function get() : Collection
    {
        return StorageLocation::query()->get();
    }
}
