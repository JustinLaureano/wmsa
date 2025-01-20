<?php

namespace App\Domain\Production\Transformers;

use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\InitiateMaterialRequestData;
use App\Domain\Production\Resolvers\RequesterResolver;
use App\Domain\Materials\Resolvers\HandlerResolver;
use App\Repositories\MaterialRepository;
use App\Repositories\MachineRepository;
use App\Repositories\StorageLocationRepository;
use Carbon\Carbon;

class MaterialRequestTransformer
{
    public static function initiateToActionData(InitiateMaterialRequestData $data) : MaterialRequestActionData
    {
        $material = (new MaterialRepository)->findByPartNumber($data->part_number);
        $quantity = $data->quantity;
        $uom = $data->unit_of_measure;
        $machine = (new MachineRepository)->findByUuid($data->machine_uuid);
        $location = (new StorageLocationRepository)->findByUuid($data->storage_location_uuid);
        $statusCode = 'OPEN'; // TODO: use enum
        $requester = RequesterResolver::getRequester($data->requester_user_uuid);
        $requestedAt = new Carbon($data->requested_at);

        return new MaterialRequestActionData(
            material: $material,
            quantity: $quantity,
            unit_of_measure: $uom,
            machine: $machine,
            location: $location,
            material_request_status_code: $statusCode,
            requester: $requester,
            requested_at: $requestedAt
        );
    }
}
