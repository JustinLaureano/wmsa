<?php

namespace App\Domain\Materials\Actions;

use App\Domain\Materials\DataTransferObjects\MaterialContainerData;
use App\Repositories\MaterialContainerRepository;

class CreateMaterialContainerAction
{
    public function handle(MaterialContainerData $data) : void
    {
        (new MaterialContainerRepository)->create($data);
    }
}
