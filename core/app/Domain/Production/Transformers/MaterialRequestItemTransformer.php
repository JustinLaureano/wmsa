<?php

namespace App\Domain\Production\Transformers;

use App\Domain\Production\Enums\RequestItemStatusEnum;
use App\Domain\Production\DataTransferObjects\Actions\MaterialRequestItemActionData;
use App\Repositories\MachineRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\StorageLocationRepository;

class MaterialRequestItemTransformer
{
    public static function payloadToActionData(object $data) : MaterialRequestItemActionData
    {
        $material = (new MaterialRepository)->findByPartNumber($data->part_number);
        $machine = null;
        $location = null;
        if ($data->machine_uuid) {
            $machine = (new MachineRepository)->findByUuid($data->machine_uuid);
        }
        if ($data->storage_location_uuid) {
            $location = (new StorageLocationRepository)->findByUuid($data->storage_location_uuid);
        }

        return new MaterialRequestItemActionData(
            material_uuid: $material->uuid,
            quantity_requested: $data->quantity_requested,
            quantity_delivered: 0,
            unit_of_measure: $data->unit_of_measure,
            machine_uuid: $machine->uuid,
            storage_location_uuid: $location->uuid,
            request_item_status_code: RequestItemStatusEnum::OPEN->value
        );
    }
}
