<?php

namespace App\Domain\Locations\Enums;

enum StorageLocationType: string
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
}
