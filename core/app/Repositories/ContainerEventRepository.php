<?php

namespace App\Repositories;

use App\Domain\Materials\DataTransferObjects\ContainerEventData;
use App\Models\ContainerEvent;

class ContainerEventRepository
{
    public function store(ContainerEventData $data) : ContainerEvent
    {
        return ContainerEvent::create($data->toArray());
    }
}
