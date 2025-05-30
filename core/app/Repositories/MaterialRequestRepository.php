<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestData;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Models\MaterialRequest;
use Illuminate\Database\Eloquent\Builder;
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
    public function getCurrentRequests(int $building_id = 1): Collection
    {
        return MaterialRequest::query()
            // Only get open requests
            ->where('material_request_status_code', '=', RequestStatusEnum::OPEN->value)
            // Make sure that the request location is in the building
            ->where(function (Builder $query) use ($building_id) {
                return $query->whereHas('items.machine', function (Builder $query) use ($building_id) {
                        $query->whereHas('building', function (Builder $query) use ($building_id) {
                            $query->where('id', '=', $building_id);
                        });
                    })
                    ->orWhereHas('items.storageLocation', function (Builder $query) use ($building_id) {
                        $query->whereHas('area.building', function (Builder $query) use ($building_id) {
                            $query->where('id', '=', $building_id);
                        });
                    });
            })
            // Order by requested at descending
            ->latest('requested_at')
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
