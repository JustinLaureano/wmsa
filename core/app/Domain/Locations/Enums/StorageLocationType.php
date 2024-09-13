<?php

namespace App\Domain\Locations\Enums;

enum StorageLocationType: string
{
    case PALLET_RACK = 'pallet-rack';
    case FLOW_RACK = 'flow-rack';
    case SHIPPING_ZONE = 'shipping-zone';
}
