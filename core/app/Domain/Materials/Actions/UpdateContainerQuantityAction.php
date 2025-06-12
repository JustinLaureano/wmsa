<?php

namespace App\Domain\Materials\Actions;

use App\Domain\Materials\DataTransferObjects\Actions\UpdateContainerQuantityActionData;
use App\Models\MaterialContainer;

class UpdateContainerQuantityAction
{
    public function handle(UpdateContainerQuantityActionData $data) : MaterialContainer
    {
        $data->container->quantity = $data->quantity;
        $data->container->save();

        // TODO: log event

        return $data->container;
    }
}
