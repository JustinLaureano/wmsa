<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestItemData;
use App\Domain\Production\Enums\RequestItemStatusEnum;
use App\Models\MaterialContainer;
use App\Models\MaterialRequestItem;
use App\Models\MaterialRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class MaterialRequestItemRepository
{
    /**
     * Store a material request item record.
     */
    public function store(MaterialRequestItemData $data) : MaterialRequestItem
    {
        return MaterialRequestItem::create($data->toArray());
    }

    /**
     * Update material request item status.
     */
    public function updateStatus(MaterialRequestItem $materialRequestItem, string $request_item_status_code): MaterialRequestItem
    {
        $materialRequestItem->update(['request_item_status_code' => $request_item_status_code]);

        return $materialRequestItem->fresh();
    }

    /**
     * Store multiple material request items.
     */
    public function insert(array $data) : void
    {
        MaterialRequestItem::insert($data);
    }

    /**
     * Store multiple material request items from a collection.
     *
     * @param Collection<MaterialRequestItemData> $items
     */
    public function collectionInsert(MaterialRequest $materialRequest, Collection $items): void
    {
        $data = $items->reduce(function ($carry, $item) use ($materialRequest) {
            $item = new MaterialRequestItemData(
                uuid: Str::uuid(),
                material_request_uuid: $materialRequest->uuid,
                material_uuid: $item->material_uuid,
                quantity_requested: $item->quantity_requested,
                quantity_delivered: $item->quantity_delivered,
                unit_of_measure: $item->unit_of_measure,
                machine_uuid: $item->machine_uuid,
                storage_location_uuid: $item->storage_location_uuid,
                request_item_status_code: $item->request_item_status_code,
                material_tote_type_uuid: $item->material_tote_type_uuid,
            );

            $carry[] = array_merge($item->toArray(), [
                'created_at' => $materialRequest->created_at,
                'updated_at' => $materialRequest->updated_at,
            ]);

            return $carry;
        }, []);

        $this->insert($data);
    }

    /**
     * Find all unallocated material request items for a material.
     */
    public function findUnallocatedForMaterialContainer(MaterialContainer $materialContainer): Collection
    {
        $query = MaterialRequestItem::query()
            ->leftJoin(
                'request_container_allocations',
                'request_container_allocations.material_request_item_uuid',
                'material_request_items.uuid',
            )
            ->where([
                ['request_item_status_code', RequestItemStatusEnum::OPEN->value],
                ['material_request_items.material_uuid', $materialContainer->material_uuid],
                ['request_container_allocations.material_request_item_uuid', null],
            ]);

        if ($materialContainer->material_tote_type_uuid === null) {
            $query->whereNull('material_request_items.material_tote_type_uuid');
        }
        else {
            $query->where(function ($query) use ($materialContainer) {
                $query->whereNull('material_request_items.material_tote_type_uuid')
                        ->orWhere(
                            'material_request_items.material_tote_type_uuid',
                            $materialContainer->material_tote_type_uuid,
                        );
            });
        }

        return $query->orderBy('material_request_items.created_at', 'asc')
            ->with('materialRequest')
            ->get();
    }
}
