<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\LaravelData\Data;

/**
 * @property string[] $permissions
 */
class RolePermissionsData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly array $permissions
    ) {

    }
}
