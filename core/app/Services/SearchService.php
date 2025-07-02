<?php

namespace App\Services;

use App\Repositories\ViewSearchIrmChemicalRepository;
use App\Repositories\ViewSearchMachineRepository;
use App\Repositories\ViewSearchMaterialRepository;
use App\Repositories\ViewSearchMaterialContainerRepository;
use App\Repositories\ViewSearchMaterialRequestRepository;
use App\Repositories\ViewSearchSortListRepository;
use App\Repositories\ViewSearchStorageLocationRepository;
use Illuminate\Support\Arr;

class SearchService
{
    public function __construct(
        protected ViewSearchIrmChemicalRepository $irmChemicalRepository,
        protected ViewSearchMachineRepository $machineRepository,
        protected ViewSearchMaterialRepository $materialRepository,
        protected ViewSearchMaterialContainerRepository $materialContainerRepository,
        protected ViewSearchMaterialRequestRepository $materialRequestRepository,
        protected ViewSearchSortListRepository $sortListRepository,
        protected ViewSearchStorageLocationRepository $storageLocationRepository,
    ) {
    }

    /**
     * Search for a query.
     */
    public function search(string $query) : array
    {
        // Return empty results if query is empty
        if (empty(trim($query))) {
            return [];
        }

        // Aggregate results from each repository
        $results = [
            'irm_chemicals' => $this->irmChemicalRepository->search($query, 6),
            'machines' => $this->machineRepository->search($query, 6),
            'materials' => $this->materialRepository->search($query, 6),
            'material_containers' => $this->materialContainerRepository->search($query, 6),
            'material_requests' => $this->materialRequestRepository->search($query, 6),
            'sort_list' => $this->sortListRepository->search($query, 6),
            'storage_locations' => $this->storageLocationRepository->search($query, 6),
        ];

        // Filter out empty result sets
        return Arr::where($results, fn($items) => !$items->isEmpty());
    }
}