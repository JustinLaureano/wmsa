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
}
