<?php

namespace App\Repositories;

use App\Domain\Materials\DataTransferObjects\ContainerLocationData;
use App\Models\ContainerLocation;

class ContainerLocationRepository
{
    public function store(ContainerLocationData $data) : ContainerLocation
    {
        return ContainerLocation::create($data->toArray());
    }
}
