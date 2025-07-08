<?php

namespace App\Domain\Materials\Services;

use App\Domain\Materials\DataTransferObjects\MaterialContainerRouting;
use App\Models\Building;
use App\Models\MaterialContainer;
use App\Models\MaterialRouting;
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
    protected string $materialUuid;
    protected int $buildingId;
    protected MaterialContainer $container;
    protected StorageLocation|null $currentLocation;
    protected Building|null $currentBuilding;

    protected StorageLocation|null $preferredDestination = null;
    protected Collection|null $availableDestinations = null;
    protected int $sequencePosition = 0;
    protected bool $isCompletionDestination = false;
    protected bool $isSortDestination = false;
    protected bool $isDegasDestination = false;
    protected Collection $destinationOrder;

    public function __construct(
        protected ContainerLocationRepository $containerLocationRepository,
        protected MaterialContainerMovementRepository $materialContainerMovementRepository,
        protected MaterialRoutingRepository $materialRoutingRepository,
        protected SortListRepository $sortListRepository,
        protected SortStorageLocationRepository $sortStorageLocationRepository,
        protected StorageLocationRepository $storageLocationRepository,
    ) {
        $this->destinationOrder = new Collection();
    }

    public function getNextDestination(MaterialContainer $container, int $buildingId)
    {
        $this->materialUuid = $container->material_uuid;
        $this->container = $container;
        $this->buildingId = $buildingId;
        $this->currentLocation = $this->getContainerCurrentLocation();
        $this->currentBuilding = $this->currentLocation?->area?->building ?? null;

        // $transferDestinations = BuildingTransferRouter::getTransferDestinations(3, 1);
        // logger()->info($transferDestinations);

        $this->handleContainerRequirements();
        $this->handleUniquePartRequirements();
        
        if (!$this->sequencePosition) {
            $this->sequencePosition = $this->getNextSequence();
        }

        if ( !$this->preferredDestination ) {
            $this->determinePreferredDestination();
        }

        return new MaterialContainerRouting(
            materialContainer: $this->container,
            preferred_destination: $this->preferredDestination,
            available_destinations: $this->availableDestinations,
            sequence_position: $this->sequencePosition,
            is_completion_destination: $this->isCompletionDestination,
            is_sort_destination: $this->isSortDestination,
            is_degas_destination: $this->isDegasDestination,
            destination_order: $this->destinationOrder,
            current_location: $this->currentLocation,
        );
    }

    protected function findAvailableStorageLocations($storageLocationAreaId, $max = 10)
    {
        $storageLocations = $this->storageLocationRepository
            ->getAvailableStorageLocationsByArea($storageLocationAreaId, $max);

        return $storageLocations;
    }

    protected function getContainerCurrentLocation(): StorageLocation|null
    {
        return $this->containerLocationRepository
            ->getContainerLocation($this->container->uuid);
    }

    protected function getNextSequence(): int
    {
        $latestSequence = $this->materialContainerMovementRepository
            ->getLatestSequence($this->container->uuid);

        return $latestSequence + 1;
    }

    protected function needsSorted(): bool
    {
        // Check if material is on the sort list
        $sortList = $this->sortListRepository->isActiveMaterial($this->materialUuid);

        // Check if the container has visited the sort location
        $hasVisitedSort = $this->materialContainerMovementRepository
            ->hasVisitedSortLocation($this->container->uuid);

        return $sortList && !$hasVisitedSort;
    }

    protected function getRoutingRules(int $sequence): Collection
    {
        // Get routing rules for the next sequence
        $buildingRules = $this->materialRoutingRepository
            ->getMaterialRoutingForBuilding($this->materialUuid, $this->buildingId, $sequence);

        $otherRules = $this->materialRoutingRepository
            ->getMaterialRoutingForOtherBuildings($this->materialUuid, $this->buildingId, $sequence);

        return $buildingRules->merge($otherRules);
    }

    protected function getDestinationOrder(): Collection
    {
        $rules = MaterialRouting::where('material_uuid', $this->materialUuid)
            ->where('building_id', $this->buildingId)
            ->orderBy('sequence')
            ->get()
            ->groupBy('sequence')
            ->map(function ($group) {
                return [
                    'preferred' => $group->where('is_preferred', true)->first(),
                    'fallbacks' => $group->where('is_preferred', false)->sortBy('fallback_order')->toArray(),
                ];
            })
            ->toArray();

        // if no rules for this building but rules for other buildings,
        // then we need to get the destination order for the other buildings
        if ($rules->isEmpty()) {
            $otherBuilding = MaterialRouting::where('material_uuid', $this->materialUuid)
                ->where('building_id', '!=', $this->buildingId)
                ->orderBy('building_id')
                ->orderBy('sequence')
                ->first();

            $rules = MaterialRouting::where('material_uuid', $this->materialUuid)
                ->where('building_id', $otherBuilding->building_id)
                ->orderBy('building_id')
                ->orderBy('sequence')
                ->get()
                ->groupBy('sequence')
                ->map(function ($group) {
                    return [
                        'preferred' => $group->where('is_preferred', true)->first(),
                        'fallbacks' => $group->where('is_preferred', false)->sortBy('fallback_order')->toArray(),
                    ];
                })
                ->toArray();
        }


        // Include sort location if applicable
        // $sortLocation = SortListLocation::where('building_id', $buildingId)->first();
        // if ($sortLocation) {
        //     $rules[0] = ['sort_location' => $sortLocation->storageLocationArea];
        // }

        return $rules;
    }

    protected function handleContainerRequirements(): void
    {
        // if ($this->needsDegassed()) {
        //     $this->setDegasDestination();
        // }

        if ($this->needsSorted()) {
            // Route to sort location
            $sortStation = $this->sortStorageLocationRepository
                ->getSortStationByBuilding($this->buildingId);

            if ($sortStation) {
                $storageLocations = $this->findAvailableStorageLocations($sortStation->storage_location_area_id, 1);
                if ($storageLocations) {

                    $this->preferredDestination = $storageLocations->first();
                    $this->availableDestinations = $storageLocations;
                    $this->sequencePosition = 0;
                    $this->isSortDestination = true;
                }
            }
            else {
                // Need to route to a building out location
                // so that it can get to the proper building
                // to visit a sort location
            }
        }

        // if ($this->needsCompletion()) {
        //     $this->setCompletionDestination();
        // }

        // if ($this->hasOpenRequest()) {
        //     $this->setOpenRequestDestination();
        // }
    }

    protected function handleUniquePartRequirements(): void
    {
        // if ($this->isThailandPart()) {
        //     $this->setThailandDestination();
        // }

        // if ($this->isToyotaTote()) {
        //     $this->setToyotaDestination();
        // }

        // if ($this->isMBDSPart()) {
        //     $this->setMBDSDestination();
        // }

        // if ($this->isServicePart()) {
        //     $this->setServicePartDestination();
        // }

        // if ($this->is807066Part()) {
        //     $this->set807066Destination();
        // }

        // if ($this->is805795Part()) {
        //     $this->set805795Destination();
        // }

        // if ($this->is300820Part()) {
        //     $this->set300820Destination();
        // }
    }

    protected function determinePreferredDestination(): void
    {
        // Get routing rules for the next sequence
        $rules = $this->getRoutingRules($this->sequencePosition);
        // dd($rules->toArray());
        foreach ($rules as $rule) {
            // If the rule is for the current building,
            // return the storage locations available for the rule
            if ($rule->building_id === $this->buildingId) {
                $storageLocations = $this->findAvailableStorageLocations($rule->storage_location_area_id, 10);
                if ($storageLocations) {
                    $this->preferredDestination = $storageLocations->first();
                    $this->availableDestinations = $storageLocations;
                    $this->sequencePosition = $this->sequencePosition;
                }
            }
            else {
                // Need to return a building out location
                // if at building out location, return building in location
                // for the next rule building and sequence
            }
        }
    }
}
