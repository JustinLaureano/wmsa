<?php

namespace App\Domain\Production\Enums;

enum RequestTypeEnum: string
{
    case TRANSFER = 'transfer';
    case SHIPPING = 'shipping';
    case IRM = 'irm';
    case PHOSPHATE = 'phosphate';
    case CARDBOARD = 'cardboard';
    case MISC = 'misc';

    public function label(): string
    {
        return match($this) {
            self::TRANSFER => 'Transfer',
            self::SHIPPING => 'Shipping',
            self::IRM => 'IRM',
            self::PHOSPHATE => 'Phosphate',
            self::CARDBOARD => 'Cardboard',
            self::MISC => 'Miscellaneous',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::TRANSFER => 'Stock Transfer between locations',
            self::SHIPPING => 'Shipping to a customer',
            self::IRM => 'IRM Movement Request',
            self::PHOSPHATE => 'Phosphate Material Request',
            self::CARDBOARD => 'Cardboard Packaging Request',
            self::MISC => 'Miscellaneous Request',
        };
    }

    /**
     * Get the valid types for material requests for a building and type.
     * Return a default array of transfer and miscellaneous
     * if the building and type are not found.
     */
    public static function toRequestValidTypesArray(string $building_id, string $type): array
    {
        if ($building_id == 1) {
            return match($type) {
                self::TRANSFER->value => [self::TRANSFER->value, self::MISC->value],
                self::IRM->value => [self::IRM->value],
                self::PHOSPHATE->value => [self::PHOSPHATE->value],
                self::CARDBOARD->value => [self::CARDBOARD->value],
                default => [self::TRANSFER->value, self::MISC->value],
            };
        }

        if ($building_id == 2) {
            return match($type) {
                self::TRANSFER->value => [self::TRANSFER->value, self::MISC->value],
                self::SHIPPING->value => [self::SHIPPING->value],
                self::CARDBOARD->value => [self::CARDBOARD->value],
                default => [self::TRANSFER->value, self::MISC->value],
            };
        }

        return [self::TRANSFER->value, self::MISC->value];
    }
}
