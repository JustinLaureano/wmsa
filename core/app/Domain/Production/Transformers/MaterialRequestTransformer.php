<?php

namespace App\Domain\Production\Transformers;

use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\DataTransferObjects\Actions\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\Requests\CreateMaterialRequestPayload;
use App\Domain\Production\DataTransferObjects\Requests\UpdateMaterialRequestStatusPayload;
use App\Domain\Production\DataTransferObjects\Actions\UpdateMaterialRequestStatusActionData;
use App\Domain\Production\Resolvers\RequesterResolver;
use App\Domain\Production\Transformers\MaterialRequestItemTransformer;
use App\Repositories\MaterialRequestRepository;
use Carbon\Carbon;

class MaterialRequestTransformer
{
    /**
     * Return an action data object from a create material request payload.
     */
    public static function createPayloadToActionData(CreateMaterialRequestPayload $data) : MaterialRequestActionData
    {
        $items = collect($data->items)->map(function ($item) {
            return MaterialRequestItemTransformer::payloadToActionData($item);
        });

        return new MaterialRequestActionData(
            items: $items,
            material_request_status_code: RequestStatusEnum::OPEN->value,
            requester: RequesterResolver::getRequester($data->requester_user_uuid),
            requested_at: new Carbon($data->requested_at)
        );
    }

    /**
     * Return an action data object from an update material request status payload.
     */
    public static function updateStatusPayloadToActionData(UpdateMaterialRequestStatusPayload $data) : UpdateMaterialRequestStatusActionData
    {
        return new UpdateMaterialRequestStatusActionData(
            materialRequest: (new MaterialRequestRepository)->findByUuid($data->uuid),
            material_request_status_code: RequestStatusEnum::from($data->status_code)->value
        );
    }
}
