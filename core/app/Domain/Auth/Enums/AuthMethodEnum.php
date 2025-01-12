<?php

namespace App\Domain\Auth\Enums;

enum AuthMethodEnum: string
{
    case DOMAIN = 'DOMAIN';
    // case ACTIVE_DIRECTORY = 'active directory';
    // case PIN = 'pin';
    case CLOCK_NUMBER = 'clock number';

    public function label() : string
    {
        // TODO: replace strings with lang strings
        return match ($this) {
            static::DOMAIN => 'Domain',
            // static::ACTIVE_DIRECTORY => 'Active Directory',
            // static::PIN => 'Pin',
            static::CLOCK_NUMBER => 'Clock Number',
        };
    }
}
