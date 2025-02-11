<?php

namespace App\Domain\Production\Transformers;

use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\InitiateMaterialRequestData;
use App\Domain\Production\Resolvers\RequesterResolver;
use Carbon\Carbon;
use App\Domain\Production\DataTransferObjects\InitiateUpdateMaterialRequestStatusData;
use App\Domain\Production\DataTransferObjects\UpdateMaterialRequestStatusData;
use App\Repositories\MaterialRequestRepository;

class MaterialRequestTransformer
{
    public static function initiateToActionData(InitiateMaterialRequestData $data) : MaterialRequestActionData
    {
        $statusCode = RequestStatusEnum::OPEN->value;
        $requester = RequesterResolver::getRequester($data->requester_user_uuid);
        $requestedAt = new Carbon($data->requested_at);

        return new MaterialRequestActionData(
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
            materialRequest: $materialRequest,
            material_request_status_code: $statusCode
        );
    }
}
