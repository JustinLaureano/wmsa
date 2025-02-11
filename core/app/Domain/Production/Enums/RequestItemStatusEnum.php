<?php

namespace App\Domain\Production\Enums;

enum RequestItemStatusEnum: string
{
    case OPEN = 'open';
    case PARTIAL = 'partial';
    case OUT_OF_STOCK = 'out-of-stock';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::OPEN => 'Open',
            self::PARTIAL => 'Partial',
            self::OUT_OF_STOCK => 'Out of Stock',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::OPEN => 'Request item is open',
            self::PARTIAL => 'Request item is partially completed',
            self::OUT_OF_STOCK => 'Request item is out of stock',
            self::COMPLETED => 'Request item has been completed',
            self::CANCELLED => 'Request item has been cancelled',
        };
    }
}
