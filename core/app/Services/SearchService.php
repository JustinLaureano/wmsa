<?php

namespace App\Services;

use App\Repositories\ViewSearchIrmChemicalRepository;
use App\Repositories\ViewSearchMaterialRepository;
use App\Repositories\ViewSearchMaterialContainerRepository;
use App\Repositories\ViewSearchStorageLocationRepository;
use App\Repositories\ViewSearchMaterialRequestRepository;
use Illuminate\Support\Arr;

class SearchService
{
    public function __construct(
        protected ViewSearchIrmChemicalRepository $irmChemicalRepository,
        protected ViewSearchMaterialRepository $materialRepository,
        protected ViewSearchMaterialContainerRepository $materialContainerRepository,
        protected ViewSearchMaterialRequestRepository $materialRequestRepository,
        protected ViewSearchStorageLocationRepository $storageLocationRepository,
    ) {
    }

    public function search($query)
    {
        // Return empty results if query is empty
        if (empty(trim($query))) {
            return [
                'irm_chemicals' => [],
                'machines' => [],
                'materials' => [],
                'material_containers' => [],
                'material_requests' => [],
                'sort_list' => [],
                'storage_locations' => [],
            ];
        }

        // Aggregate results from each repository
        $results = [
            'irm_chemicals' => $this->irmChemicalRepository->search($query, 8),
            'machines' => [],
            'materials' => $this->materialRepository->search($query, 8),
            'material_containers' => $this->materialContainerRepository->search($query, 8),
            'material_requests' => $this->materialRequestRepository->search($query, 8),
            'sort_list' => [],
            'storage_locations' => $this->storageLocationRepository->search($query, 8),
        ];

        // Filter out empty result sets
        return Arr::where($results, fn($items) => !empty($items));
    }
}