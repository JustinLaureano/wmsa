<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestData;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\Enums\RequestTypeEnum;
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
     * Get the current requests by building and type.
     * 
     * This list is populated by combining open requests and recently closed requests.
     */
    public function getCurrentRequests(int $building_id = 1, string $type = 'transfer'): Collection
    {
        $open = $this->getOpenRequests($building_id, $type);
        $closed = $this->getRecentlyClosedRequests($building_id, $type);

        return $open->merge($closed);
    }

    /**
     * Get the open requests by building and type.
     */
    public function getOpenRequests(int $building_id = 1, string $type = 'transfer'): Collection
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
            // Make sure that the request type is in the valid types
            ->whereIn(
                'material_request_type_code',
                RequestTypeEnum::toRequestValidTypesArray($building_id, $type)
            )
            // Order by requested at descending
            ->latest('requested_at')
            // Load all appropriate relationships
            ->with([
                'status',
                'type',
                'requester.teammate',
                'items' => [
                    'material',
                    'machine',
                    'storageLocation',
                    'containerAllocation',
                    'availableMaterialContainers',
                    'status'
                    ]
            ])
            ->get();
    }

    /**
     * Get the recently closed requests by building and type.
     */
    public function getRecentlyClosedRequests(int $building_id = 1, string $type = 'transfer'): Collection
    {
        return MaterialRequest::query()
            // Only get closed requests
            ->whereIn('material_request_status_code', RequestStatusEnum::toClosedArray())
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
            // Make sure that the request type is in the valid types
            ->whereIn(
                'material_request_type_code',
                RequestTypeEnum::toRequestValidTypesArray($building_id, $type)
            )
            // Only get recently updated requests
            ->lastTenMinutes('updated_at')
            // Load all appropriate relationships
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
            ->limit(15)
            ->get();
    }
}
