<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestItemData;
use App\Models\MaterialRequestItem;

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
}
