<?php

namespace App\Domain\Materials\Enums;

enum ContainerEventEnum: string
{
    case RECEIVED = 'received';
    case PICKED_UP = 'picked-up';
    case SCANNED = 'scanned';
    case QUANTITY_ADJUSTMENT = 'quantity-adjustment';
    case SHIPPED = 'shipped';
}
