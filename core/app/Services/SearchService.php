<?php

namespace App\Services;

use App\Repositories\ViewSearchIrmChemicalRepository;
use App\Repositories\ViewSearchMaterialRepository;
use App\Repositories\ViewSearchMaterialContainerRepository;
use App\Repositories\ViewSearchStorageLocationRepository;
use Illuminate\Support\Arr;

class SearchService
{
    public function __construct(
        protected ViewSearchIrmChemicalRepository $irmChemicalRepository,
        protected ViewSearchMaterialRepository $materialRepository,
        protected ViewSearchMaterialContainerRepository $materialContainerRepository,
        protected ViewSearchStorageLocationRepository $storageLocationRepository
    ) {
    }

    public function search($query)
    {
        // Return empty results if query is empty
        if (empty(trim($query))) {
            return [
                'irm_chemicals' => [],
                'materials' => [],
                'material_containers' => [],
                'storage_locations' => [],
            ];
        }

        // Aggregate results from each repository
        $results = [
            'irm_chemicals' => $this->irmChemicalRepository->search($query, 8),
            'materials' => $this->materialRepository->search($query, 8),
            'material_containers' => $this->materialContainerRepository->search($query, 8),
            'storage_locations' => $this->storageLocationRepository->search($query, 8),
        ];

        // Filter out empty result sets
        return Arr::where($results, fn($items) => !empty($items));
    }
}