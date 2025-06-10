<?php

namespace App\Domain\Quality\Enums;

enum SortListTypeEnum: string
{
    case INTERNAL = 'internal';
    case CUSTOMER = 'customer';
    case LAUNCH = 'launch';

    public function label(): string
    {
        return match($this) {
            self::INTERNAL => 'Internal',
            self::CUSTOMER => 'Customer',
            self::LAUNCH => 'Launch',
        };
    }
}
