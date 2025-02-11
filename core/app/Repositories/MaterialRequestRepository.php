<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestData;
use App\Models\MaterialRequest;
use Illuminate\Support\Collection;

class MaterialRequestRepository
{
    /**
     * Find a material request by UUID.
     */
    public function findByUuid(string $uuid): MaterialRequest
    {
        return MaterialRequest::where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Store a material request record.
     */
    public function store(MaterialRequestData $data) : MaterialRequest
    {
        return MaterialRequest::create($data->toArray());
    }

    /**
     * Update material request status.
     */
    public function updateStatus(MaterialRequest $materialRequest, string $material_request_status_code): MaterialRequest
    {
        $materialRequest->update(['material_request_status_code' => $material_request_status_code]);

        return $materialRequest->fresh();
    }

    /**
     * Get the current requests.
     */
    public function getCurrentRequests(int $limit = 10): Collection
    {
        return MaterialRequest::query()
            ->latest()
            ->limit($limit)
            ->with([
                'status',
                'type',
                'requester.teammate',
                'items' => [
                    'material',
                    'machine',
                    'storageLocation',
                    'containerAllocation',
                    'status'
                ]
            ])
            ->get();
    }
}
