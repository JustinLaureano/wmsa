<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchStorageLocation;
use Illuminate\Database\Eloquent\Collection;

class ViewSearchStorageLocationRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchStorageLocation::query()
            ->search($query)
            ->take($limit)
            ->get()
            ->map(function ($location) {
                $location->search_type = 'storage_location';
                return $location;
            });
    }
}
