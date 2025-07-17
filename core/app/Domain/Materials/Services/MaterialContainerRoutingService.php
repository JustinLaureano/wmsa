<?php

namespace App\Domain\Materials\Services;

use App\Domain\Locations\Enums\BuildingIdEnum;
use App\Domain\Locations\Support\BuildingTransferRouter;
use App\Domain\Materials\DataTransferObjects\MaterialContainerRouting;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Models\Building;
use App\Models\MaterialContainer;
use App\Models\MaterialRouting;
use App\Models\StorageLocation;
use App\Repositories\BuildingTransferAreaRepository;
use App\Repositories\ContainerLocationRepository;
use App\Repositories\MaterialContainerMovementRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialRequestItemRepository;
use App\Repositories\MaterialRoutingRepository;
use App\Repositories\MaterialToteTypeRepository;
use App\Repositories\SortListRepository;
use App\Repositories\SortStorageLocationRepository;
use App\Repositories\StorageLocationAreaRepository;
use App\Repositories\StorageLocationRepository;
use Illuminate\Database\Eloquent\Collection;

class MaterialContainerRoutingService
{
    protected BuildingTransferAreaRepository $buildingTransferAreaRepository;
    protected ContainerLocationRepository $containerLocationRepository;
    protected MaterialRepository $materialRepository;
    protected MaterialContainerMovementRepository $materialContainerMovementRepository;
    protected MaterialRequestItemRepository $materialRequestItemRepository;
    protected MaterialRoutingRepository $materialRoutingRepository;
    protected SortListRepository $sortListRepository;
    protected SortStorageLocationRepository $sortStorageLocationRepository;
    protected StorageLocationRepository $storageLocationRepository;
    protected StorageLocationAreaRepository $storageLocationAreaRepository;

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
     * Whether the container has conditional routing rules.
     */
    protected bool $isConditionalRouting = false;

    /**
     * The locations that are excluded from being returned as a destination..
     *
     * @var Collection<StorageLocation>|null
     */
    protected Collection|null $excludedLocations = null;

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
     * Whether the next destination is a repack destination.
     */
    protected bool $isRepackDestination = false;

    /**
     * The routing order of the destinations for the container
     * according to the active routing rules.
     *
     * @var Collection<StorageLocation>
     */
    protected Collection $destinationOrder;

    public function __construct() {
        $this->buildingTransferAreaRepository = new BuildingTransferAreaRepository();
        $this->containerLocationRepository = new ContainerLocationRepository();
        $this->materialRepository = new MaterialRepository();
        $this->materialContainerMovementRepository = new MaterialContainerMovementRepository();
        $this->materialRequestItemRepository = new MaterialRequestItemRepository();
        $this->materialRoutingRepository = new MaterialRoutingRepository();
        $this->sortListRepository = new SortListRepository();
        $this->sortStorageLocationRepository = new SortStorageLocationRepository();
        $this->storageLocationRepository = new StorageLocationRepository();
        $this->storageLocationAreaRepository = new StorageLocationAreaRepository();
        $this->destinationOrder = new Collection();
    }

    public function getNextDestination(MaterialContainer $container, int $buildingId)
    {
        $this->materialUuid = $container->material_uuid;
        $this->setContainer($container);
        $this->container = $container;
        $this->buildingId = $buildingId;
        $this->setContainerCurrentLocation();
        $this->currentBuilding = $this->currentLocation?->area?->building ?? null;

        // $transferDestinations = BuildingTransferRouter::getTransferDestinations(3, 1);
        // logger()->info($transferDestinations);

        $this->handleContainerRequirements();
        $this->handleUniquePartRequirements();

        $this->setRoutingRules();

        if ($this->nextSequenceNeedsSet()) {
            $this->setNextSequence();
        }

        if ($this->routeBuildingIdNeedsSet()) {
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
            is_repack_destination: $this->isRepackDestination,
            destination_order: $this->destinationOrder,
            current_location: $this->currentLocation,
        );
    }

    /**
     * Set the container for the service, including the barcode label.
     */
    protected function setContainer(MaterialContainer $container): void
    {
        $container->load('material');
        $container->barcode_label = BarcodeFactory::make($container->barcode)->toArray();

        $this->container = $container;
    }

    /**
     * Find available storage locations for a given storage location area id.
     */
    protected function findAvailableStorageLocations($storageLocationAreaId, $max = 1000)
    {
        $excludedLocations = $this->excludedLocations ?? new Collection();
        $excludedUuids = $excludedLocations->pluck('uuid')->implode(',');

        $storageLocations = $this->storageLocationRepository
            ->getAvailableStorageLocationsByArea($storageLocationAreaId, $excludedUuids, $max);

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
                $this->routeBuildingId = $rule[0]->route_building_id;
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
                ->getMaterialRoutingForBuilding(
                    $this->materialUuid,
                    $this->container->material_tote_type_uuid,
                    BuildingIdEnum::PLANT_2->value,
                ),
            2 => $this->materialRoutingRepository
                ->getMaterialRoutingForBuilding(
                    $this->materialUuid,
                    $this->container->material_tote_type_uuid,
                    BuildingIdEnum::BLACKHAWK->value,
                ),
            3 => $this->materialRoutingRepository
                ->getMaterialRoutingForBuilding(
                    $this->materialUuid,
                    $this->container->material_tote_type_uuid,
                    BuildingIdEnum::DEFIANCE->value,
                ),
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
        if ($this->needsDegassed()) {
            $this->setDegasRouting();
        }

        else if ($this->needsSorted()) {
            $this->setSortRouting();
        }

        else if ($this->needsCompletion()) {
            $this->setCompletionRouting();
        }

        else {
            $this->handleMaterialRequestRouting();
        }
    }

    protected function handleUniquePartRequirements(): void
    {
        if ($this->isThailandPart()) {
            $this->setThailandPartDestination();
        }

        if ($this->isToyotaTote()) {
            $this->handleToyotaToteRouting();
        }

        // if ($this->isMBDSPart()) {
        //     $this->setMBDSDestination();
        // }

        if ($this->isServicePart()) {
            $this->handleServicePartRequirements();
        }

        if ($this->is805795Part()) {
            $this->handle805795Routing();
        }
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

                if ($this->preferredDestination) {
                    break;
                }
            }
        }
    }

    /**
     * Determines if the container needs to be completed based on the material's
     * completion requirement and if it has visited the completion location.
     */
    protected function needsDegassed(): bool
    {
        $requiresDegassing = $this->materialRepository->requiresDegassing($this->materialUuid);

        $hasVisitedDegassing = $this->materialContainerMovementRepository
            ->hasVisitedDegasLocation($this->container->uuid);

        return $requiresDegassing && !$hasVisitedDegassing;
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

    /**
     * Determines if the container needs to be repacked based on if it has
     * visited the repack location.
     */
    protected function needsRepacked(): bool
    {
        return ! $this->materialContainerMovementRepository
            ->hasVisitedRepackLocation($this->container->uuid);
    }

    /**
     * Thailand parts have lot numbers designated with a Shift Identifier Suffix of 'T'.
     */
    protected function isThailandPart(): bool
    {
        return str_contains(
            strtolower($this->container->lot_number),
            't'
        );
    }

    /**
     * Determines if the container is a Toyota tote container.
     */
    protected function isToyotaTote(): bool
    {
        return (new MaterialToteTypeRepository())->isToyotaToteContainer($this->container);
    }

    /**
     * Determines if the container is a 805795 part.
     */
    protected function is805795Part(): bool
    {
        return $this->container->material->part_number === '805795';
    }

    /**
     * Determines if the container is a service part.
     */
    protected function isServicePart(): bool
    {
        return $this->container->material->service_part === 1;
    }

    /**
     * Handles the routing for the container based on any open material requests
     * that require this material but do not have a container allocated.
     * 
     * Any material request items for machines will be routed to 
     * the staging location of the machine.
     * 
     * If the container is in the request location building, it will 
     * be routed directly to the request location.
     * 
     * If the container is in an offsite warehouse, it will be routed 
     * to the inbound location of the request location building.
     * 
     * If the container is in one of the main onsite warehouses that is not the
     * warehouse that the request is for, it will be routed to the outbound
     * location, or the inbound location of the request location building.
     */
    protected function handleMaterialRequestRouting(): void
    {
        $openRequests = $this->materialRequestItemRepository->findUnallocatedForMaterialContainer($this->container);

        if ($openRequests->isEmpty()) return;

        $availableRequestLocations = new Collection();

        foreach ($openRequests as $requestItem) {

            if ($requestItem->machine) {
                $requestLocation = $this->storageLocationRepository
                    ->getStagingLocationByMachine($requestItem->machine->barcode);
            }
            else {
                $requestLocation = $requestItem->storageLocation;
            }

            if (!$requestLocation) continue;

            $requestLocationBuildingId = $requestLocation->area->building->id;

            if (
                !$this->currentLocation ||
                $this->currentBuilding?->id === $requestLocationBuildingId
            ) {
                $availableRequestLocations->push($requestLocation);
            }

            else if ( $this->containerInOffSiteWarehouseLocation() ) {
                $inboundLocationAreaId = $this->buildingTransferAreaRepository
                    ->getInboundStorageLocationAreaId($requestLocationBuildingId);

                $inboundLocation = $this->storageLocationRepository
                    ->getAvailableStorageLocationsByArea($inboundLocationAreaId, 1);

                $availableRequestLocations->push($inboundLocation);
            }

            else if ( $this->containerInOnsiteLocation() ) {
                $transferDestinations = BuildingTransferRouter::getTransferDestinations(
                    $this->currentBuilding->id,
                    $requestLocationBuildingId
                );

                if ( $this->containerCurrentlyInLocationArray($transferDestinations['outbound_storage_locations']) ) {
                    $inboundLocation = $transferDestinations['inbound_storage_locations']->first();
                    $availableRequestLocations->push($inboundLocation);
                }
                else {
                    $outboundLocation = $transferDestinations['outbound_storage_locations']->first();
                    $availableRequestLocations->push($outboundLocation);
                }
            }
        }

        if ($availableRequestLocations->isNotEmpty()) {
            $this->preferredDestination = $availableRequestLocations->first();
            $this->availableDestinations = $availableRequestLocations;
            $this->isConditionalRouting = true;
        }

        // TODO: add required locations to travel to the destination order list
    }

    /**
     * Sets the appropriate routing destination for the container
     * to visit a sort location.
     * 
     * If the part is currently located in Plant 2 or Blackhawk,
     * there is sort stations in those buildings, so it will be routed
     * directly to the appropriate sort location.
     * 
     * If the container is in the defiance warehouse, it will be routed
     * to the outbound location if necessary, and then the inbound location
     * of either Blackhawk (preferred) or Plant 2.
     * 
     * If the container does not have a current location, then we can assume
     * it is a new skid manufactured in either Plant 2 or Blackhawk, and will
     * route to the sort locations of those buildings.
     * 
     * If it is determined to be in an offsite warehouse, we can route the
     * container to the inbound locations of Plant 2 and Blackhawk.
     * 
     * Whatever appropriate steps are required to get to the sort station
     * will be appended to the destination order list.
     */
    protected function setSortRouting(): void
    {
        if (
            !$this->currentBuilding
        ) {
            $plant2SortStation = $this->sortStorageLocationRepository
                ->getSortStationByBuilding(BuildingIdEnum::PLANT_2->value);

            $blackhawkSortStation = $this->sortStorageLocationRepository
                ->getSortStationByBuilding(BuildingIdEnum::BLACKHAWK->value);

            $plant2StorageLocations = $this->findAvailableStorageLocations($plant2SortStation->storage_location_area_id, 1);
            $blackhawkStorageLocations = $this->findAvailableStorageLocations($blackhawkSortStation->storage_location_area_id, 1);

            if ($plant2StorageLocations && $plant2StorageLocations->isNotEmpty()) {
                $this->preferredDestination = $plant2StorageLocations->first();
                $this->availableDestinations = $plant2StorageLocations;
                $this->isSortDestination = true;
            }
            
            if ($blackhawkStorageLocations && $blackhawkStorageLocations->isNotEmpty()) {
                if (!$this->preferredDestination) {
                    $this->preferredDestination = $blackhawkStorageLocations->first();
                    $this->isSortDestination = true;
                }

                $this->availableDestinations->push($blackhawkStorageLocations);
            }
        }

        else if ( $this->containerInOffSiteWarehouseLocation() ) {
            $this->handleOffsiteToPlant2Transfer();
        }

        else if ( $this->containerLocatedInPlantTwoOrBlackhawk() ) {
            // Route directly to sort location
            $sortStation = $this->sortStorageLocationRepository
                ->getSortStationByBuilding($this->currentBuilding->id);

            if (!$sortStation) return;

            $storageLocations = $this->findAvailableStorageLocations($sortStation->storage_location_area_id, 1);

            if ($storageLocations && $storageLocations->isNotEmpty()) {
                $this->preferredDestination = $storageLocations->first();
                $this->availableDestinations = $storageLocations;
                $this->isSortDestination = true;
            }
        }

        else if ( $this->containerLocatedInDefianceBuilding() ) {
            $this->handleDefianceToBlackhawkTransfer();
        }

        if ($this->preferredDestination) {
            $this->isConditionalRouting = true;
        }

        // TODO: add required locations to travel to the destination order list
    }

    /**
     * Sets the appropriate routing destination for the container
     * to visit a completion location.
     * 
     * If the part is currently located in Plant 2 or Blackhawk,
     * there is completion stations in those buildings, so it will be routed
     * directly to the appropriate completion location.
     * 
     * If the container is in the defiance warehouse, it will be routed
     * to the outbound location if necessary, and then the inbound location
     * of either Blackhawk (preferred) or Plant 2.
     *
     * If the container does not have a current location, then we can assume
     * it is a new skid manufactured in either Plant 2 or Blackhawk, and will
     * route to the completion locations of those buildings.
     * 
     * If it is determined to be in an offsite warehouse, we can route the
     * container to the inbound locations of Plant 2 and Blackhawk.
     *
     * Whatever appropriate steps are required to get to the completion station
     * will be appended to the destination order list.
     */
    protected function setCompletionRouting(): void
    {
        if (
            !$this->currentBuilding
        ) {
            $plant2CompletionStation = $this->storageLocationRepository
                ->getCompletionStationByBuilding(BuildingIdEnum::PLANT_2->value);

            $blackhawkCompletionStation = $this->storageLocationRepository
                ->getCompletionStationByBuilding(BuildingIdEnum::BLACKHAWK->value);

            $plant2StorageLocations = $this->findAvailableStorageLocations($plant2CompletionStation->storage_location_area_id, 1);
            $blackhawkStorageLocations = $this->findAvailableStorageLocations($blackhawkCompletionStation->storage_location_area_id, 1);

            if ($plant2StorageLocations && $plant2StorageLocations->isNotEmpty()) {
                $this->preferredDestination = $plant2StorageLocations->first();
                $this->availableDestinations = $plant2StorageLocations;
                $this->isCompletionDestination = true;
            }
            
            if ($blackhawkStorageLocations && $blackhawkStorageLocations->isNotEmpty()) {
                if (!$this->preferredDestination) {
                    $this->preferredDestination = $blackhawkStorageLocations->first();
                    $this->isCompletionDestination = true;
                }

                $this->availableDestinations->push($blackhawkStorageLocations);
            }
        }

        else if ( $this->containerInOffSiteWarehouseLocation() ) {
            $this->handleOffsiteToPlant2Transfer();
        }

        else if ( $this->containerLocatedInPlantTwoOrBlackhawk() ) {
            // Route directly to sort location
            $completionStation = $this->storageLocationRepository
                ->getCompletionStationByBuilding($this->currentBuilding->id);

            if (!$completionStation) return;

            $storageLocations = $this->findAvailableStorageLocations($completionStation->storage_location_area_id, 1);

            if ($storageLocations && $storageLocations->isNotEmpty()) {
                $this->preferredDestination = $storageLocations->first();
                $this->availableDestinations = $storageLocations;
                $this->isCompletionDestination = true;
            }
        }

        else if ( $this->containerLocatedInDefianceBuilding() ) {
            $this->handleDefianceToBlackhawkTransfer();
        }

        if ($this->preferredDestination) {
            $this->isConditionalRouting = true;
        }

        // TODO: add required locations to travel to the destination order list
    }

    /**
     * Sets the appropriate routing destination for the container
     * to visit a degas location.
     * 
     * If the container is currently located in Plant,
     * it will be routed to the degas location.
     *
     * If the container is located in an offsite warehouse, it will be routed
     * to the inbound locations of Plant 2 and Blackhawk.
     *
     * If the container is located in the defiance building, it will be routed
     * to the outbound location if necessary, and then the inbound location
     * of Plant 2.
     */
    protected function setDegasRouting(): void
    {
        if (
            !$this->currentBuilding ||
            $this->containerLocatedInPlant2Building()
        ) {
            $degasAreaIds = $this->storageLocationRepository
                ->getDegasAreaIds();

            $degasLocations = new Collection();

            foreach ($degasAreaIds as $degasAreaId) {
                $storageLocations = $this->findAvailableStorageLocations($degasAreaId, 1);

                if ($storageLocations && $storageLocations->isNotEmpty()) {
                    $degasLocations->push($storageLocations->first());
                }
            }

            if ($degasLocations && $degasLocations->isNotEmpty()) {
                $this->preferredDestination = $degasLocations->first();
                $this->availableDestinations = $degasLocations;
                $this->isDegasDestination = true;
            }
        }

        else if ( $this->containerInOffSiteWarehouseLocation() ) {
            $this->handleOffsiteToPlant2Transfer();
        }

        else if ( $this->containerLocatedInBlackhawkOrDefiance() ) {
            $transferDestinations = BuildingTransferRouter::getTransferDestinations(
                $this->currentBuilding->id,
                BuildingIdEnum::PLANT_2->value
            );

            if ($this->containerCurrentlyInLocationArray($transferDestinations['outbound_storage_locations']) ) {
                $this->preferredDestination = $transferDestinations['inbound_storage_locations']->first();
                $this->availableDestinations = $transferDestinations['inbound_storage_locations'];
            }

            else {
                $this->preferredDestination = $transferDestinations['outbound_storage_locations']->first();
                $this->availableDestinations = $transferDestinations['outbound_storage_locations'];
            }
        }

        if ($this->preferredDestination) {
            $this->isConditionalRouting = true;
        }

        // TODO: add required locations to travel to the destination order list
    }

    /**
     * Sets the appropriate routing destination for the container
     * to visit a repack location.
     * 
     * If the container is currently located in Plant 2 or Blackhawk,
     * it will be routed to the repack locations of those buildings.
     * 
     * If the container is located in an offsite warehouse, it will be routed
     * to the inbound locations of Plant 2 and Blackhawk.
     * 
     * If the container is located in the defiance building, it will be routed
     * to the outbound location if necessary, and then the inbound location
     * of Blackhawk.
     */
    protected function setRepackRouting(): void
    {
        if (
            !$this->currentBuilding ||
            $this->containerLocatedInPlantTwoOrBlackhawk()
        ) {
            $repackAreaIds = $this->storageLocationAreaRepository
                ->getRepackAreaIdsByBuilding($this->currentBuilding?->id ?? BuildingIdEnum::PLANT_2->value);

            $repackLocations = new Collection();

            foreach ($repackAreaIds as $repackAreaId) {
                $storageLocations = $this->findAvailableStorageLocations($repackAreaId, 1);

                if ($storageLocations && $storageLocations->isNotEmpty()) {
                    $repackLocations->push($storageLocations->first());
                }
            }

            if ($repackLocations && $repackLocations->isNotEmpty()) {
                $this->preferredDestination = $repackLocations->first();
                $this->availableDestinations = $repackLocations;
                $this->isRepackDestination = true;
            }
        }

        else if ( $this->containerInOffSiteWarehouseLocation() ) {
            $this->handleOffsiteToPlant2Transfer();
        }

        else if ( $this->containerLocatedInDefianceBuilding() ) {
            $transferDestinations = BuildingTransferRouter::getTransferDestinations(
                BuildingIdEnum::DEFIANCE->value,
                BuildingIdEnum::BLACKHAWK->value
            );

            if ($this->containerCurrentlyInLocationArray($transferDestinations['outbound_storage_locations']) ) {
                $this->preferredDestination = $transferDestinations['inbound_storage_locations']->first();
                $this->availableDestinations = $transferDestinations['inbound_storage_locations'];
            }

            else {
                $this->preferredDestination = $transferDestinations['outbound_storage_locations']->first();
                $this->availableDestinations = $transferDestinations['outbound_storage_locations'];
            }
        }

        if ($this->preferredDestination) {
            $this->isConditionalRouting = true;
        }

        // TODO: add required locations to travel to the destination order list
    }

    /**
     * Thailand parts need to repacked, sorted, and completed before
     * allowed to be putaway in the assigned storage location.
     */
    protected function setThailandPartDestination(): void
    {
        if ($this->needsRepacked()) {
            $this->setRepackRouting();
        }

        else if ($this->needsSorted()) {
            $this->setSortRouting();
        }

        else if ($this->needsCompletion()) {
            $this->setCompletionRouting();
        }
    }

    /**
     * Handles the routing for a container that is in a Toyota tote.
     * 
     * If the container already has a preferred destination, do nothing
     * since it has requirements for Completion and potentially Sort
     * before being put away.
     * 
     * If the container is currently located in Blackhawk, it will be routed
     * to the Toyota racks.
     * 
     * If the container is located in any other warehouse , it will be routed
     * to the inbound location of Blackhawk.
     * 
     * If the container is located in an onsite location, it will be routed to
     * via the building transfer rules as needed.
     */
    protected function handleToyotaToteRouting(): void
    {
        if ($this->preferredDestination) return;

        if (
            !$this->currentBuilding ||
            $this->containerLocatedInBlackhawkBuilding()
        ) {
            $toyotaAreaId = $this->storageLocationAreaRepository
                ->getRackAreaId(BuildingIdEnum::BLACKHAWK->value, 'TOY');

            $storageLocations = $this->findAvailableStorageLocations($toyotaAreaId, 10);

            if ($storageLocations && $storageLocations->isNotEmpty()) {
                $this->preferredDestination = $storageLocations->first();
                $this->availableDestinations = $storageLocations;
            }
        }

        else if ($this->containerInOffSiteWarehouseLocation()) {
            $blackhawkInboundLocationAreaId = $this->buildingTransferAreaRepository
                ->getInboundStorageLocationAreaId(BuildingIdEnum::BLACKHAWK->value);

            $storageLocations = $this->findAvailableStorageLocations($blackhawkInboundLocationAreaId, 1);

            if ($storageLocations && $storageLocations->isNotEmpty()) {
                $this->preferredDestination = $storageLocations->first();
                $this->availableDestinations = $storageLocations;
            }
        }

        else if ($this->containerInOnsiteLocation()) {
            $transferDestinations = BuildingTransferRouter::getTransferDestinations(
                $this->currentBuilding->id,
                BuildingIdEnum::BLACKHAWK->value
            );

            if ( $this->containerCurrentlyInLocationArray($transferDestinations['outbound_storage_locations']) ) {
                $inboundLocation = $transferDestinations['inbound_storage_locations']->first();
                $this->preferredDestination = $inboundLocation;
                $this->availableDestinations = $transferDestinations['inbound_storage_locations'];
            }
            else {
                $outboundLocation = $transferDestinations['outbound_storage_locations']->first();
                $this->preferredDestination = $outboundLocation;
                $this->availableDestinations = $transferDestinations['outbound_storage_locations'];
            }
        }

        if ($this->preferredDestination) {
            $this->isConditionalRouting = true;
        }

        // TODO: add required locations to travel to the destination order list
    }

    /**
     * Service parts cannot be stored in certain CMET storage racks.
     * 
     * Will find all CMET storage locations in the Blackhawk building and
     * exclude the ones that are in aisles 1 and 2.
     */
    protected function handleServicePartRequirements(): void
    {
        $cmetAreaId = $this->storageLocationAreaRepository
            ->getRackAreaId(BuildingIdEnum::BLACKHAWK->value, 'CMET');

        $cmetLocations = $this->findAvailableStorageLocations($cmetAreaId);

        $excludedLocations = $cmetLocations->filter(function ($location) {
            return $location->aisle <= 2;
        });

        if ($excludedLocations && $excludedLocations->isNotEmpty()) {
            $this->excludedLocations = $excludedLocations;
        }
    }

    /**
     * Handles the routing for a container that is a 805795 part.
     * 
     * If the container is currently located in Blackhawk, it will be routed
     * to the service rack if the container quantity is less than 305.
     * 
     * If those conditions are not met, then the base routing logic will be used.
     */
    protected function handle805795Routing(): void
    {
        if ($this->preferredDestination) return;

        if (
            $this->container->quantity < 305 &&
            $this->currentBuilding?->id === BuildingIdEnum::BLACKHAWK->value
        ) {

            $svcAreaId = $this->storageLocationAreaRepository
                ->getRackAreaId(BuildingIdEnum::BLACKHAWK->value, 'SVC');

            $serviceLocations = $this->findAvailableStorageLocations($svcAreaId);

            $storageLocations = $serviceLocations->filter(function ($location) {
                return $location->aisle === 5;
            });

            if ($storageLocations && $storageLocations->isNotEmpty()) {
                $this->preferredDestination = $storageLocations->first(); 
                $this->availableDestinations = $storageLocations->take(15);
            }
        }
    }

    /**
     * The next sequence is determined to be set if the sequence position
     * if null and there is not already conditional routing set that
     * negates the need for a sequencial position.
     */
    protected function nextSequenceNeedsSet(): bool
    {
        return  $this->sequencePosition === null &&
                !$this->isConditionalRouting;
    }

    /**
     * The route building id is determined to be set if the route building id
     * if null and there is not already conditional routing set that
     * negates the need for a route building id.
     */
    protected function routeBuildingIdNeedsSet(): bool
    {
        return  $this->routeBuildingId === null &&
                !$this->isConditionalRouting;
    }

    /**
     * Determines if the container is currently located in Plant 2.
     */
    protected function containerLocatedInPlant2Building(): bool
    {
        return $this->currentBuilding?->id === BuildingIdEnum::PLANT_2->value;
    }

    /**
     * Determines if the container is currently located in Blackhawk.
     */
    protected function containerLocatedInBlackhawkBuilding(): bool
    {
        return $this->currentBuilding?->id === BuildingIdEnum::BLACKHAWK->value;
    }

    /**
     * Determines if the container is located in plant two or blackhawk.
     */
    protected function containerLocatedInPlantTwoOrBlackhawk(): bool
    {
        return  $this->currentBuilding?->id === BuildingIdEnum::PLANT_2->value ||
                $this->currentBuilding?->id === BuildingIdEnum::BLACKHAWK->value;
    }

    /**
     * Determines if the container is located in blackhawk or defiance.
     */
    protected function containerLocatedInBlackhawkOrDefiance(): bool
    {
        return $this->currentBuilding?->id === BuildingIdEnum::BLACKHAWK->value ||
               $this->currentBuilding?->id === BuildingIdEnum::DEFIANCE->value;
    }

    /**
     * Determines if the container is located in the defiance building.
     */
    protected function containerLocatedInDefianceBuilding(): bool
    {
        return $this->currentBuilding?->id === BuildingIdEnum::DEFIANCE->value;
    }

    /**
     * Determines if the container is located in an offsite warehouse.
     */
    protected function containerInOffSiteWarehouseLocation(): bool
    {
        if (!$this->currentLocation) return false;

        return $this->currentLocation->area->building_id !== BuildingIdEnum::PLANT_2->value &&
               $this->currentLocation->area->building_id !== BuildingIdEnum::BLACKHAWK->value &&
               $this->currentLocation->area->building_id !== BuildingIdEnum::DEFIANCE->value;
    }

    /**
     * Determines if the container is located in an onsite location.
     */
    protected function containerInOnsiteLocation(): bool
    {
        if (!$this->currentLocation) return false;

        return $this->currentLocation->area->building_id === BuildingIdEnum::PLANT_2->value ||
               $this->currentLocation->area->building_id === BuildingIdEnum::BLACKHAWK->value ||
               $this->currentLocation->area->building_id === BuildingIdEnum::DEFIANCE->value;
    }

    /**
     * Determines if the container is located in the outbound location of a given building.
     */
    protected function containerInOutboundLocation(int $buildingId): bool
    {
        if (!$this->currentLocation) return false;

        $outboundLocationId = $this->buildingTransferAreaRepository
            ->getOutboundStorageLocationAreaId($buildingId);

        return $this->currentLocation->area->id === $outboundLocationId;
    }

    /**
     * Determins if the container's current location is one of the locations
     * in the given location Collection.
     */
    protected function containerCurrentlyInLocationArray(Collection $locations): bool
    {
        if (!$this->currentLocation) return false;

        foreach ($locations as $location) {
            if ($location->uuid === $this->currentLocation->uuid) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handles the transfer of moving container from the Defiance building
     * to the Blackhawk (preferred) or Plant 2 as additional option.
     */
    public function handleDefianceToBlackhawkTransfer(): void
    {
        if ($this->containerInOutboundLocation(BuildingIdEnum::DEFIANCE->value)) {
            $blackhawkInboundLocationAreaId = $this->buildingTransferAreaRepository
                ->getInboundStorageLocationAreaId(BuildingIdEnum::BLACKHAWK->value);
            
            $plantTwoInboundLocationAreaId = $this->buildingTransferAreaRepository
                ->getInboundStorageLocationAreaId(BuildingIdEnum::PLANT_2->value);

            $blackhawkStorageLocations = $this->findAvailableStorageLocations($blackhawkInboundLocationAreaId, 1);
            $plantTwoStorageLocations = $this->findAvailableStorageLocations($plantTwoInboundLocationAreaId, 1);

            if ($blackhawkStorageLocations && $blackhawkStorageLocations->isNotEmpty()) {
                $this->preferredDestination = $blackhawkStorageLocations->first();
                $this->availableDestinations = $blackhawkStorageLocations;
            }

            if ($plantTwoStorageLocations && $plantTwoStorageLocations->isNotEmpty()) {
                if (!$this->preferredDestination) {
                    $this->preferredDestination = $plantTwoStorageLocations->first();
                }

                $this->availableDestinations->push($plantTwoStorageLocations);
            }
        }
        else {
            $defianceOutboundLocationAreaId = $this->buildingTransferAreaRepository
                ->getOutboundStorageLocationAreaId(BuildingIdEnum::DEFIANCE->value);

            $storageLocations = $this->findAvailableStorageLocations($defianceOutboundLocationAreaId, 1);

            if ($storageLocations && $storageLocations->isNotEmpty()) {
                $this->preferredDestination = $storageLocations->first();
                $this->availableDestinations = $storageLocations;
            }
        }
    }

    /**
     * Handles the transfer of moving container from an offsite warehouse
     * to the Plant 2 (preferred) or Blackhawk as additional option.
     */
    public function handleOffsiteToPlant2Transfer(): void
    {
        $plant2InboundLocationAreaId = $this->buildingTransferAreaRepository
            ->getInboundStorageLocationAreaId(BuildingIdEnum::PLANT_2->value);

        $blackhawkInboundLocationAreaId = $this->buildingTransferAreaRepository
            ->getInboundStorageLocationAreaId(BuildingIdEnum::BLACKHAWK->value);

        $plant2StorageLocations = $this->findAvailableStorageLocations($plant2InboundLocationAreaId, 1);    
        $blackhawkStorageLocations = $this->findAvailableStorageLocations($blackhawkInboundLocationAreaId, 1);

        if ($plant2StorageLocations && $plant2StorageLocations->isNotEmpty()) {
            $this->preferredDestination = $plant2StorageLocations->first();
            $this->availableDestinations = $plant2StorageLocations;
        }

        if ($blackhawkStorageLocations && $blackhawkStorageLocations->isNotEmpty()) {
            if (!$this->preferredDestination) {
                $this->preferredDestination = $blackhawkStorageLocations->first();
            }

            $this->availableDestinations->push($blackhawkStorageLocations);
        }
    }
}
