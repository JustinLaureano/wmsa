<?php

namespace App\Domain\Production\Enums;

enum RequestStatusEnum: string
{
    case OPEN = 'open';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::OPEN => 'Open',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }
}