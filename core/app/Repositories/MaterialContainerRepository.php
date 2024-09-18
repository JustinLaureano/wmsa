<?php

namespace App\Repositories;

use App\Domain\Materials\DataTransferObjects\MaterialContainerData;
use App\Models\MaterialContainer;

class MaterialContainerRepository
{
    public function create(MaterialContainerData $data) : MaterialContainer
    {
        return MaterialContainer::create($data->toArray());
    }
}
