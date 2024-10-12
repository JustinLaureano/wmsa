<?php

namespace App\Domain\Auth\Enums;

enum PermissionEnum: string
{
    case CREATE_STORAGE_LOCATIONS = 'create storage locations';
    case TRANSFER_MATERIAL_STOCK = 'transfer material stock';
    case UPDATE_CONTAINER_MOVEMENT_STATUS = 'update container movement status';

    public function label() : string
    {
        // TODO: replace strings with lang strings
        return match ($this) {
            static::CREATE_STORAGE_LOCATIONS => 'Create Storage Locations',
            static::TRANSFER_MATERIAL_STOCK => 'Transfer Material Stock',
            static::UPDATE_CONTAINER_MOVEMENT_STATUS => 'Update Container Movement Status',
        };
    }
}
