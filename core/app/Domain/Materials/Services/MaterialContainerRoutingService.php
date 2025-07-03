<?php

namespace App\Domain\Materials\Services;

use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use App\Repositories\ContainerLocationRepository;
use App\Repositories\MaterialContainerMovementRepository;
use App\Repositories\MaterialRoutingRepository;
use App\Repositories\SortListRepository;
use App\Repositories\SortStorageLocationRepository;
use App\Repositories\StorageLocationRepository;
use Illuminate\Database\Eloquent\Collection;

class MaterialContainerRoutingService
{
    public function __construct(
        protected ContainerLocationRepository $containerLocationRepository,
        protected MaterialContainerMovementRepository $materialContainerMovementRepository,
        protected MaterialRoutingRepository $materialRoutingRepository,
        protected SortListRepository $sortListRepository,
        protected SortStorageLocationRepository $sortStorageLocationRepository,
        protected StorageLocationRepository $storageLocationRepository,
    ) {
    }

    public function getNextDestination(MaterialContainer $container, int $buildingId)
    {
        $materialUuid = $container->material_uuid;

        $currentLocation = $this->getContainerCurrentLocation($container);

        if ($this->needsSorted($materialUuid, $container->uuid)) {
            // Route to sort location
            $sortStation = $this->sortStorageLocationRepository
                ->getSortStationByBuilding($buildingId);

            if ($sortStation) {
                $storageLocation = $this->findAvailableStorageLocations($sortStation->storage_location_area_id, 1);
                if ($storageLocation) {
                    return [
                        'storage_location_uuid' => $storageLocation->uuid,
                        'is_sort_location' => true,
                        'sequence' => null, // Sort location doesn't count in sequence
                    ];
                }
            }
            else {
                // Need to route to a building out location
                // so that it can get to the proper building
                // to visit a sort location
            }
        }

        // Find the next routing sequence
        $nextSequence = $this->getNextSequence($container->uuid);

        // Get routing rules for the next sequence
        $rules = $this->getRoutingRules($materialUuid, $buildingId, $nextSequence);

        foreach ($rules as $rule) {
            // If the rule is for the current building,
            // return the storage locations available for the rule
            if ($rule->building_id === $buildingId) {
                $storageLocations = $this->findAvailableStorageLocations($rule->storage_location_area_id, 10);
                if ($storageLocations) {
                    return [
                        'preferred' => $storageLocations->first(),
                        'all' => $storageLocations,
                    ];
                }
            }
            else {
                // Need to return a building out location
                // if at building out location, return building in location
                // for the next rule building and sequence
            }

        }

        return null; // No available destinations
    }

    protected function findAvailableStorageLocations($storageLocationAreaId, $max = 10)
    {
        $storageLocations = $this->storageLocationRepository
            ->getAvailableStorageLocationsByArea($storageLocationAreaId, $max);

        return $max === 1
            ? $storageLocations->first()
            : $storageLocations;
    }

    protected function getContainerCurrentLocation(MaterialContainer $container): StorageLocation|null
    {
        return $this->containerLocationRepository
            ->getContainerLocation($container->uuid);
    }

    protected function getNextSequence(string $containerUuid): int
    {
        $latestSequence = $this->materialContainerMovementRepository
            ->getLatestSequence($containerUuid);

        return $latestSequence + 1;
    }

    protected function needsSorted(string $materialUuid, string $containerUuid): bool
    {
        // Check if material is on the sort list
        $sortList = $this->sortListRepository->isActiveMaterial($materialUuid);

        // Check if the container has visited the sort location
        $hasVisitedSort = $this->materialContainerMovementRepository
            ->hasVisitedSortLocation($containerUuid);

        return $sortList && !$hasVisitedSort;
    }

    protected function getRoutingRules(string $materialUuid, int $buildingId, int $sequence): Collection
    {
        // Get routing rules for the next sequence
        $buildingRules = $this->materialRoutingRepository
            ->getMaterialRoutingForBuilding($materialUuid, $buildingId, $sequence);

        $otherRules = $this->materialRoutingRepository
            ->getMaterialRoutingForOtherBuildings($materialUuid, $buildingId, $sequence);

        return $buildingRules->merge($otherRules);
    }
}