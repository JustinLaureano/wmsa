<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchStorageLocation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchStorageLocationRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_storage_location_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchStorageLocation::search($query)
                    ->take($limit)
                    ->get()
                    ->map(function ($location) {
                        $location->key = $location->storage_location_uuid;
                        $location->primary_text = $location->storage_location_name;
                        $location->secondary_text = $location->building_name;
                        $location->search_type = 'storage_location';
                        $location->url = route('locations.show', $location->storage_location_uuid);
                        return $location;
                    });
        });
    }
}
