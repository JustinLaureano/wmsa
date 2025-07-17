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
        string|null $materialToteTypeUuid,
        int $buildingId
    ): Collection
    {
        $query = MaterialRouting::query()
        ->where([
            ['material_uuid', $materialUuid],
            ['route_building_id', $buildingId],
        ]);

        if ($materialToteTypeUuid) {
            $query->where(function ($query) use ($materialToteTypeUuid) {
                $query->whereNull('material_tote_type_uuid')
                    ->orWhere('material_tote_type_uuid', $materialToteTypeUuid);
            })
            ->orderBy('material_tote_type_uuid', 'desc');
        }
        else {
            $query->whereNull('material_tote_type_uuid');
        }

        return $query->orderBy('is_preferred', 'desc')
            ->orderBy('fallback_order')
            ->get();
    }
}
