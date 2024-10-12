<?php

namespace App\Domain\Auth\Access;

use App\Domain\Auth\DataTransferObjects\RolePermissionsData;
use App\Domain\Auth\Enums\PermissionEnum;
use App\Domain\Auth\Enums\RoleEnum;

class RolePermissionsProvider
{
    /**
     * Return an array of the roles with permissions used
     * within the application to allow or deny access
     * to perform certain business actions.
     */
    public static function toArray() : array
    {
        return [
            new RolePermissionsData(
                name: RoleEnum::IRM_MANAGER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::MATERIAL_HANDLER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::PRODUCTION_SUPERVISOR->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::QUALITY_MANAGER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_CONTAINER_MOVEMENT_STATUS->value,
                ]
            ),
        ];
    }
}