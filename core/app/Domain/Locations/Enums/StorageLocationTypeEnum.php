<?php

namespace App\Domain\Locations\Enums;

enum StorageLocationTypeEnum: string
{
    case PALLET_RACK = 'pallet-rack';
    case FLOW_RACK = 'flow-rack';
    case MOLD_RACK = 'mold-rack';
    case SHIPPING_ZONE = 'shipping-zone';
    case RECEIVING_ZONE = 'receiving-zone';
    case BUILDING_EXIT = 'building-exit';
    case INVENTORY_RELIEF = 'inventory-relief';
    case SORT = 'sort';
    case FLOOR = 'floor';
    case TRAILER = 'trailer';
    case RECYCLING = 'recycling';
    case REPACK = 'repack';

    public function label(): string
    {
        return match ($this) {
            self::PALLET_RACK => 'Pallet Rack',
            self::FLOW_RACK => 'Flow Rack',
            self::MOLD_RACK => 'Mold Rack',
            self::SHIPPING_ZONE => 'Shipping Zone',
            self::RECEIVING_ZONE => 'Receiving Zone',
            self::BUILDING_EXIT => 'Building Exit',
            self::INVENTORY_RELIEF => 'Inventory Relief',
            self::SORT => 'Sort',
            self::FLOOR => 'Floor',
            self::TRAILER => 'Trailer',
            self::RECYCLING => 'Recycling',
            self::REPACK => 'Repack',
        };
    }
}
