<?php

namespace App\Domain\Production\Transformers;

use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\InitiateMaterialRequestData;
use App\Domain\Production\Resolvers\RequesterResolver;
use App\Repositories\MaterialRepository;
use App\Repositories\MachineRepository;
use App\Repositories\StorageLocationRepository;
use Carbon\Carbon;
use App\Domain\Production\DataTransferObjects\InitiateUpdateMaterialRequestStatusData;
use App\Domain\Production\DataTransferObjects\UpdateMaterialRequestStatusData;
use App\Repositories\MaterialRequestRepository;

class MaterialRequestTransformer
{
    public static function initiateToActionData(InitiateMaterialRequestData $data) : MaterialRequestActionData
    {
        $material = (new MaterialRepository)->findByPartNumber($data->part_number);
        $quantity = $data->quantity;
        $uom = $data->unit_of_measure;
        $machine = null;
        $location = null;
        if ($data->machine_uuid) {
            $machine = (new MachineRepository)->findByUuid($data->machine_uuid);
        }
        if ($data->storage_location_uuid) {
            $location = (new StorageLocationRepository)->findByUuid($data->storage_location_uuid);
        }
        $statusCode = RequestStatusEnum::OPEN->value;
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

    public static function initiateUpdateStatusToActionData(InitiateUpdateMaterialRequestStatusData $data) : UpdateMaterialRequestStatusData
    {
        $materialRequest = (new MaterialRequestRepository)->findByUuid($data->uuid);
        $statusCode = RequestStatusEnum::from($data->status_code)->value;

        return new UpdateMaterialRequestStatusData(
            uuid: $materialRequest->uuid,
            material_request_status_code: $statusCode
        );
    }
}
