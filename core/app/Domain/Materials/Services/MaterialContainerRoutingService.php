<?php

namespace App\Services;

use App\Domain\Locations\Enums\BuildingIdEnum;
use App\Models\MaterialContainer;
use App\Models\MaterialRouting;
use App\Models\StorageLocation;
use App\Repositories\MaterialContainerMovementRepository;
use App\Repositories\SortListRepository;
use App\Repositories\SortStorageLocationRepository;

class MaterialContainerRoutingService
{
    public function getNextDestination(MaterialContainer $container, int $buildingId)
    {
        $material = $container->material;
        $currentBuildingId = $buildingId; // Current building or user's building

        // Check if material is on the sort list
        $sortList = (new SortListRepository)->isActiveMaterial($material->uuid);

        // Check if the container has visited the sort location
        $hasVisitedSort = (new MaterialContainerMovementRepository)
            ->hasVisitedSortLocation($container->uuid);

        if ($sortList && !$hasVisitedSort) {
            // Route to sort location
            $sortStation = (new SortStorageLocationRepository)
                ->getSortStationByBuilding($currentBuildingId ?? BuildingIdEnum::PLANT_2->value);

            if ($sortStation) {
                $storageLocation = $this->findAvailableStorageLocation($sortStation->storage_location_area_id);
                if ($storageLocation) {
                    return [
                        'storage_location_uuid' => $storageLocation->uuid,
                        'is_sort_location' => true,
                        'sequence' => 0, // Sort location doesn't count in sequence
                    ];
                }
            }
            else {
                // Need to route to a building out location
                // so that it can get to the proper building
                // to visit a sort location
            }
        }

        // Get the latest movement sequence
        $latestSequence = (new MaterialContainerMovementRepository)
            ->getLatestSequence($container->uuid);

        $nextSequence = $latestSequence + 1;

        // Get routing rules for the next sequence
        $rules = MaterialRouting::where('material_uuid', $material->uuid)
            ->where('building_id', $currentBuildingId)
            ->where('sequence', $nextSequence)
            ->orderBy('is_preferred', 'desc')
            ->orderBy('fallback_order')
            ->get();

        foreach ($rules as $rule) {
            $storageLocation = $this->findAvailableStorageLocation($rule->storage_location_area_id);
            if ($storageLocation) {
                return [
                    'storage_location_uuid' => $storageLocation->uuid,
                    'is_sort_location' => false,
                    'sequence' => $nextSequence,
                ];
            }
        }

        return null; // No available destinations
    }

    protected function findAvailableStorageLocation($storageLocationAreaId)
    {
        return StorageLocation::where('storage_location_area_id', $storageLocationAreaId)
            ->where('disabled', false)
            ->where('reservable', true)
            ->where(function ($query) {
                $query->whereNull('max_containers')
                    ->orWhereRaw('(SELECT COUNT(*) FROM container_locations cl WHERE cl.storage_location_uuid = storage_locations.uuid AND cl.deleted_at IS NULL) < max_containers');
            })
            ->first();
    }

    // public function recordMovement($materialContainerUuid, $storageLocationUuid, $sequence, $isSortLocation)
    // {
    //     MaterialContainerMovement::create([
    //         'uuid' => (string) Str::uuid(),
    //         'material_container_uuid' => $materialContainerUuid,
    //         'storage_location_uuid' => $storageLocationUuid,
    //         'sequence' => $sequence,
    //         'is_sort_location' => $isSortLocation,
    //     ]);

    //     // Update container_locations
    //     \DB::table('container_locations')
    //         ->where('material_container_uuid', $materialContainerUuid)
    //         ->update(['deleted_at' => now()]);

    //     \DB::table('container_locations')->insert([
    //         'material_container_uuid' => $materialContainerUuid,
    //         'storage_location_uuid' => $storageLocationUuid,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);
    // }
}