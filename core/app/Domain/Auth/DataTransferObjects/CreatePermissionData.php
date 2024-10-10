<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\LaravelData\Data;

class CreatePermissionData extends Data
{
    public function __construct(
        public readonly string $name
    ) {

    }
}
