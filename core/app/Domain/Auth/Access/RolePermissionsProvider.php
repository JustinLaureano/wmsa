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
                name: RoleEnum::FINANCE->value,
                permissions: [
                    PermissionEnum::VIEW_MATERIAL_COSTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::IRM_MANAGER->value,
                permissions: [
                    PermissionEnum::PERFORM_INVENTORY_AUDIT->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_CEMENT_METAL_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_COMPOUND_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_IRM_CHEMICAL_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                    PermissionEnum::UPDATE_MATERIAL_ROUTING->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::IRM_PRODUCTION_OPERATOR->value,
                permissions: [
                    PermissionEnum::PERFORM_INVENTORY_AUDIT->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::IT_ADMINISTRATOR->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_BARCODE_PRESS_SCANS->value,
                    PermissionEnum::UPDATE_TOYOTA_WORKSPACES->value,
                    PermissionEnum::UPDATE_USER_AUTHORIZATIONS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::MATERIAL_HANDLER->value,
                permissions: [
                    PermissionEnum::PERFORM_INVENTORY_AUDIT->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::TRANSFER_MOLDS->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::MATERIALS_CONTROL->value,
                permissions: [
                    PermissionEnum::PERFORM_INVENTORY_AUDIT->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_BARCODE_PRESS_SCANS->value,
                    PermissionEnum::UPDATE_CEMENT_METAL_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_COMPOUND_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_IRM_CHEMICAL_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_PROPERTIES->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                    PermissionEnum::UPDATE_MATERIAL_ROUTING->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::MOLDING->value,
                permissions: [
                    PermissionEnum::TRANSFER_MOLDS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::PRODUCTION_MANAGER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_BARCODE_PRESS_SCANS->value,
                    PermissionEnum::UPDATE_CEMENT_METAL_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_COMPOUND_SAFETY_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                    PermissionEnum::UPDATE_SORT_INVENTORY->value,
                    PermissionEnum::UPDATE_USER_AUTHORIZATIONS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::PRODUCTION_OPERATOR->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::PRODUCTION_SCHEDULER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::PRODUCTION_SHIPPING->value,
                permissions: [
                    PermissionEnum::PRINT_CARDBOARD_LABELS->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::PRODUCTION_SUPERVISOR->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                    PermissionEnum::UPDATE_SORT_INVENTORY->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::QUALITY_ENGINEER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_CONTAINER_MOVEMENT_STATUS->value,
                    PermissionEnum::UPDATE_SORT_INVENTORY->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::QUALITY_MANAGER->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_CONTAINER_MOVEMENT_STATUS->value,
                    PermissionEnum::UPDATE_MATERIAL_ROUTING->value,
                    PermissionEnum::UPDATE_SORT_INVENTORY->value,
                    PermissionEnum::UPDATE_SORT_LIST->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::QUALITY_TECHNICIAN->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_CONTAINER_MOVEMENT_STATUS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::SHIPPING_CLERK->value,
                permissions: [
                    PermissionEnum::PRINT_CARDBOARD_LABELS->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_SHIPPING_DOCUMENTS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::SHIPPING_SUPERVISOR->value,
                permissions: [
                    PermissionEnum::PRINT_CARDBOARD_LABELS->value,
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                    PermissionEnum::UPDATE_TOYOTA_WORKSPACES->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::SORT->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_SORT_INVENTORY->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::TEAM_LEAD->value,
                permissions: [
                    PermissionEnum::TRANSFER_MATERIAL_STOCK->value,
                    PermissionEnum::UPDATE_MATERIAL_REQUESTS->value,
                    PermissionEnum::UPDATE_SORT_INVENTORY->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::TECHNICAL_ADMINISTRATOR->value,
                permissions: [
                    PermissionEnum::PRINT_CARDBOARD_LABELS->value,
                ]
            ),
            new RolePermissionsData(
                name: RoleEnum::TOOLING->value,
                permissions: [
                    PermissionEnum::TRANSFER_MOLDS->value,
                ]
            ),
        ];
    }
}