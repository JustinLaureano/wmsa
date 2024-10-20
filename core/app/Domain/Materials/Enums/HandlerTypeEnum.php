<?php

namespace App\Domain\Materials\Enums;

enum HandlerTypeEnum: string
{
    case TEAMMATE = 'teammate';

    public static function toArray(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }
}
