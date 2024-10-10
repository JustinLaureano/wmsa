<?php

namespace App\Domain\Auth\Enums;

enum PermissionEnum: string
{
    case TRANSFER_MATERIAL_STOCK = 'transfer material stock';

    public function label() : string
    {
        return match ($this) {
            static::TRANSFER_MATERIAL_STOCK => 'Transfer Material Stock',
        };
    }
}
