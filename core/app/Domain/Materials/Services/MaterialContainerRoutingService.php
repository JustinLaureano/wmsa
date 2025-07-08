<?php

namespace App\Domain\Materials\Services;

use App\Domain\Locations\Enums\BuildingIdEnum;
use App\Domain\Materials\DataTransferObjects\MaterialContainerRouting;
use App\Models\Building;
use App\Models\MaterialContainer;
use App\Models\MaterialRouting;
use App\Models\StorageLocation;
use App\Repositories\ContainerLocationRepository;
use App\Repositories\MaterialContainerMovementRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialRoutingRepository;
use App\Repositories\SortListRepository;
use App\Repositories\SortStorageLocationRepository;
use App\Repositories\StorageLocationRepository;
use Illuminate\Database\Eloquent\Collection;

class MaterialContainerRoutingService
{
    /**
     * The material uuid for the container material.
     */
    protected string $materialUuid;

    /**
     * The building id given to the service,
     * used to determine the next destination.
     */
    protected int $buildingId;

    /**
     * The container for the material.
     */
    protected MaterialContainer $container;

    /**
     * The current storage location for the container.
     */
    protected StorageLocation|null $currentLocation;

    /**
     * The current building for the container.
     */
    protected Building|null $currentBuilding;

    /**
     * The routing rules for the material.
     *
     * @var \Illuminate\Support\Collection<int, Collection<MaterialRouting>>
     */
    protected \Illuminate\Support\Collection $routingRules;

    /**
     * The active route for the container.
     *
     * @var Collection<MaterialRouting>
     */
    protected \Illuminate\Support\Collection $activeRoute;

    /**
     * The next preferred destination for the container.
     */
    protected StorageLocation|null $preferredDestination = null;

    /**
     * The available suitable destinations for the container
     * based on the current sequence position and route building id.
     *
     * @var Collection<StorageLocation>|null
     */
    protected Collection|null $availableDestinations = null;

    /**
     * The building id for the next destination.
     */
    protected int|null $routeBuildingId = null;

    /**
     * The sequence position for the next destination.
     */
    protected int|null $sequencePosition = null;

    /**
     * Whether the next destination is a completion destination.
     */
    protected bool $isCompletionDestination = false;

    /**
     * Whether the next destination is a sort destination.
     */
    protected bool $isSortDestination = false;

    /**
     * Whether the next destination is a degas destination.
     */
    protected bool $isDegasDestination = false;

    /**
     * The routing order of the destinations for the container
     * according to the active routing rules.
     *
     * @var Collection<StorageLocation>
     */
    protected Collection $destinationOrder;

    public function __construct(
        protected ContainerLocationRepository $containerLocationRepository,
        protected MaterialRepository $materialRepository,
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
        $this->setContainerCurrentLocation();
        $this->currentBuilding = $this->currentLocation?->area?->building ?? null;

        // $transferDestinations = BuildingTransferRouter::getTransferDestinations(3, 1);
        // logger()->info($transferDestinations);

        $this->handleContainerRequirements();
        $this->handleUniquePartRequirements();

        $this->setRoutingRules();

        if ($this->sequencePosition === null) {
            $this->setNextSequence();
        }

        if ($this->routeBuildingId === null) {
            $this->setRouteBuildingId();
        }

        if ($this->preferredDestination === null) {
            $this->determinePreferredDestination();
        }

        return new MaterialContainerRouting(
            materialContainer: $this->container,
            preferred_destination: $this->preferredDestination,
            available_destinations: $this->availableDestinations,
            route_building_id: $this->routeBuildingId,
            sequence_position: $this->sequencePosition,
            is_completion_destination: $this->isCompletionDestination,
            is_sort_destination: $this->isSortDestination,
            is_degas_destination: $this->isDegasDestination,
            destination_order: $this->destinationOrder,
            current_location: $this->currentLocation,
        );
    }

    /**
     * Find available storage locations for a given storage location area id.
     */
    protected function findAvailableStorageLocations($storageLocationAreaId, $max = 10)
    {
        $storageLocations = $this->storageLocationRepository
            ->getAvailableStorageLocationsByArea($storageLocationAreaId, $max);

        return $storageLocations;
    }

    /**
     * Set the current storage location for the container if it exists.
     */
    protected function setContainerCurrentLocation(): void
    {
        $this->currentLocation = $this->containerLocationRepository
            ->getContainerLocation($this->container->uuid);
    }

    /**
     * Set the next sequence for the container based on the latest movement.
     * If there was a movement, the route building id will be set to
     * match the latest movement sequence.
     *
     * If no movement exists, set the sequence to 1.
     */
    protected function setNextSequence(): void
    {
        $latestSequenceMovement = $this->materialContainerMovementRepository
            ->getLatestSequenceMovement($this->container->uuid);

        if (!$latestSequenceMovement) {
            $this->sequencePosition = 1;
        }
        else {
            $this->sequencePosition = $latestSequenceMovement->sequence + 1;
            $this->routeBuildingId = $latestSequenceMovement->route_building_id;
        }
    }

    /**
     * Set the route building id if one has not been established
     * yet based on either the current building, or if there is
     * not a route for that building, then set it to the next
     * building in the routing rules.
     */
    protected function setRouteBuildingId(): void
    {
        if ($this->currentBuilding) {
            $this->routeBuildingId = $this->currentBuilding->id;
        }
        else {
            $rule = null;
            foreach ($this->routingRules as $routingRule) {
                if ($routingRule && $routingRule->isNotEmpty()) {
                    $rule = $routingRule;
                    break;
                }
            }

            if ($rule) {
                $this->routeBuildingId = $rule->route_building_id;
            }
        }
    }

    /**
     * Set the routing rules for the material for
     * each main building.
     */
    protected function setRoutingRules(): void
    {
        $this->routingRules = new \Illuminate\Support\Collection([
            1 => $this->materialRoutingRepository
                ->getMaterialRoutingForBuilding($this->materialUuid, BuildingIdEnum::PLANT_2->value),
            2 => $this->materialRoutingRepository
                ->getMaterialRoutingForBuilding($this->materialUuid, BuildingIdEnum::BLACKHAWK->value),
            3 => $this->materialRoutingRepository
                ->getMaterialRoutingForBuilding($this->materialUuid, BuildingIdEnum::DEFIANCE->value),
        ]);
    }

    /**
     * Handles the container requirements for the material,
     * such as if it needs to be sorted, degassed, etc.
     *
     * If any of these conditions are met, the appropriate
     * properties will be determined and set. These will
     * dictate the next destination for the container,
     * based on the situation.
     */
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
                    $this->sequencePosition = null;
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
        if ($this->routeBuildingId === null) {
            return;
        }

        foreach ($this->routingRules as $routeBuildingId => $routes) {
            if ($routeBuildingId === $this->routeBuildingId) {
                $this->activeRoute = $routes;
                break;
            }
        }

        foreach ($this->activeRoute as $route) {
            if ($route->sequence === $this->sequencePosition) {
                $storageLocations = $this->findAvailableStorageLocations($route->storage_location_area_id, 10);

                if ($storageLocations) {
                    $this->preferredDestination = $storageLocations->first();
                    $this->availableDestinations = $storageLocations;
                }

                break;
            }
        }
    }

    /**
     * Determines if the container needs to be sorted based on the material's
     * sort list status and if it has visited the sort location.
     */
    protected function needsSorted(): bool
    {
        // Check if material is on the sort list
        $sortList = $this->sortListRepository->isActiveMaterial($this->materialUuid);

        // Check if the container has visited the sort location
        $hasVisitedSort = $this->materialContainerMovementRepository
            ->hasVisitedSortLocation($this->container->uuid);

        return $sortList && !$hasVisitedSort;
    }

    /**
     * Determines if the container needs to be completed based on the material's
     * completion requirement and if it has visited the completion location.
     */
    protected function needsCompletion(): bool
    {
        $requiresCompletion = $this->materialRepository->requiresCompletion($this->materialUuid);

        $hasVisitedCompletion = $this->materialContainerMovementRepository
            ->hasVisitedCompletionLocation($this->container->uuid);

        return $requiresCompletion && !$hasVisitedCompletion;
    }

    protected function setCompletionDestination(): void
    {
        // If in building one or two, send to completion station in current building

        // if in another building
        // check if currently in outbound location
        // if in outbound location, send to inbound location of other sort building
        // if not in outbound location, send to outbound location

        // add required locations to travel to the destination order list
    }
}
