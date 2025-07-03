<?php

namespace App\Repositories;

use App\Models\MaterialRouting;
use Illuminate\Database\Eloquent\Collection;

class MaterialRoutingRepository
{
    /**
     * Return the routing rules for a given
     * material, building, and sequence.
     */
    public function getMaterialRoutingForBuilding(
        string $materialUuid,
        int $buildingId,
        int $sequence
    ): Collection
    {
        return MaterialRouting::query()
            ->where('material_uuid', $materialUuid)
            ->where('building_id', $buildingId)
            ->where('sequence', $sequence)
            ->orderBy('is_preferred', 'desc')
            ->orderBy('fallback_order')
            ->get();
    }

    /**
     * Return the routing rules for a given
     * material and sequence that are not
     * for the given building.
     */
    public function getMaterialRoutingForOtherBuildings(
        string $materialUuid,
        int $buildingId,
        int $sequence
    ): Collection
    {
        return MaterialRouting::query()
            ->where('material_uuid', $materialUuid)
            ->where('building_id', '<>', $buildingId)
            ->where('sequence', $sequence)
            ->orderBy('is_preferred', 'desc')
            ->orderBy('fallback_order')
            ->get();
    }
}
