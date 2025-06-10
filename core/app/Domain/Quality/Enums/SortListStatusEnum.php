<?php

namespace App\Domain\Quality\Enums;

enum SortListStatusEnum: string
{
    case OPEN = 'open';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match($this) {
            self::OPEN => 'Open',
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::CLOSED => 'Closed',
        };
    }
}
