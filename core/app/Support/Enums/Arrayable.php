<?php

namespace App\Support\Enums;

trait Arrayable
{
    /**
     * Return the enum values as an array.
     */
    public static function toArray(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }
}
