<?php

namespace App\Domain\Materials\DataTransferObjects\Actions;

use App\Domain\Materials\DataTransferObjects\Requests\UpdateContainerQuantityPayload;
use App\Models\MaterialContainer;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use App\Repositories\MaterialContainerRepository;
use App\Repositories\UserRepository;

class UpdateContainerQuantityActionData extends Data
{
    public function __construct(
        public readonly MaterialContainer $container,
        public readonly int $quantity,
        public readonly User $user,
        public readonly Carbon $updatedAt,
    ) {

    }

    /**
     * Create a new UpdateContainerQuantityActionData instance from a request payload.
     */
    public static function fromPayload(UpdateContainerQuantityPayload $payload) : UpdateContainerQuantityActionData
    {
        $container = (new MaterialContainerRepository())->findByUuid($payload->material_container_uuid);

        if ( !$container ) {    
            throw new \Exception('Container not found');
        }

        $user = (new UserRepository())->findBy('uuid', $payload->user_uuid);

        if ( !$user ) {
            throw new \Exception('User not found');
        }

        return new self($container, $payload->quantity, $user, Carbon::parse($payload->updated_at));
    }
}
