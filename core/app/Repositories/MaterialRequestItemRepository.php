<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestItemData;
use App\Models\MaterialRequestItem;
use App\Models\MaterialRequest;
use Illuminate\Support\Collection;

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
                material_request_uuid: $materialRequest->uuid,
                material_uuid: $item->material_uuid,
                quantity_requested: $item->quantity_requested,
                quantity_delivered: $item->quantity_delivered,
                unit_of_measure: $item->unit_of_measure,
                machine_uuid: $item->machine_uuid,
                storage_location_uuid: $item->storage_location_uuid,
                request_item_status_code: $item->request_item_status_code,
            );

            $carry[] = $item->toArray();

            return $carry;
        }, []);

        $this->insert($data);
    }
}
