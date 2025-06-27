<?php

namespace App\Domain\Auth\Enums;

enum PermissionEnum: string
{
    case CREATE_STORAGE_LOCATIONS = 'create storage locations';
    case PERFORM_INVENTORY_AUDIT = 'perform inventory audit';
    case PRINT_CARDBOARD_LABELS = 'print cardboard labels';
    case TRANSFER_MATERIAL_STOCK = 'transfer material stock';
    case TRANSFER_MOLDS = 'transfer molds';
    case UPDATE_BARCODE_PRESS_SCANS = 'update barcode press scans';
    case UPDATE_CEMENT_METAL_SAFETY_STOCK = 'update cement metal safety stock';
    case UPDATE_COMPOUND_SAFETY_STOCK = 'update compound safety stock';
    case UPDATE_CONTAINER_MOVEMENT_STATUS = 'update container movement status';
    case UPDATE_IRM_CHEMICAL_SAFETY_STOCK = 'update irm chemical safety stock';
    case UPDATE_MATERIAL_PROPERTIES = 'update material properties';
    case UPDATE_MATERIAL_REQUESTS = 'update material requests';
    case UPDATE_MATERIAL_ROUTING = 'update material routing';
    case UPDATE_SHIPPING_DOCUMENTS = 'update shipping documents';
    case UPDATE_SORT_INVENTORY = 'update sort inventory';
    case UPDATE_SORT_LIST = 'update sort list';
    case UPDATE_TOYOTA_WORKSPACES = 'update toyota workspaces';
    case UPDATE_USER_AUTHORIZATIONS = 'update user authorizations';
    case VIEW_MATERIAL_COSTS = 'view material costs';

    public function label() : string
    {
        // TODO: replace strings with lang strings
        return match ($this) {
            static::CREATE_STORAGE_LOCATIONS => __('frontend.create_storage_locations'),
            static::PERFORM_INVENTORY_AUDIT => __('frontend.perform_inventory_audit'),
            static::PRINT_CARDBOARD_LABELS => __('frontend.print_cardboard_labels'),
            static::TRANSFER_MATERIAL_STOCK => __('frontend.transfer_material_stock'),
            static::TRANSFER_MOLDS => __('frontend.transfer_molds'),
            static::UPDATE_BARCODE_PRESS_SCANS => __('frontend.update_barcode_press_scans'),
            static::UPDATE_CEMENT_METAL_SAFETY_STOCK => __('frontend.update_cement_metal_safety_stock'),
            static::UPDATE_COMPOUND_SAFETY_STOCK => __('frontend.update_compound_safety_stock'),
            static::UPDATE_CONTAINER_MOVEMENT_STATUS => __('frontend.update_container_movement_status'),
            static::UPDATE_IRM_CHEMICAL_SAFETY_STOCK => __('frontend.update_irm_chemical_safety_stock'),
            static::UPDATE_MATERIAL_PROPERTIES => __('frontend.update_material_properties'),
            static::UPDATE_MATERIAL_REQUESTS => __('frontend.update_material_requests'),
            static::UPDATE_MATERIAL_ROUTING => __('frontend.update_material_routing'),
            static::UPDATE_SHIPPING_DOCUMENTS => __('frontend.update_shipping_documents'),
            static::UPDATE_SORT_INVENTORY => __('frontend.update_sort_inventory'),
            static::UPDATE_SORT_LIST => __('frontend.update_sort_list'),
            static::UPDATE_TOYOTA_WORKSPACES => __('frontend.update_toyota_workspaces'),
            static::UPDATE_USER_AUTHORIZATIONS => __('frontend.update_user_authorizations'),
            static::VIEW_MATERIAL_COSTS => __('frontend.view_material_costs'),
        };
    }
}
