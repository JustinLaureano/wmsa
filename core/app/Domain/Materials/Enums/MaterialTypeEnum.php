<?php

namespace App\Domain\Materials\Enums;

enum MaterialTypeEnum: string
{
    case RAW_MATERIALS = 'raw-materials';
    case SEMI_FINISHED_GOODS = 'semi-finished-goods';
    case FINISHED_GOODS = 'finished-goods';
    case PACKAGING_MATERIALS = 'packaging-materials';
    case MISCELLANEOUS = 'miscellaneous';

    public function label(): string
    {
        return match($this) {
            self::RAW_MATERIALS => 'Raw Materials',
            self::SEMI_FINISHED_GOODS => 'Semi-Finished Goods',
            self::FINISHED_GOODS => 'Finished Goods',
            self::PACKAGING_MATERIALS => 'Packaging Materials',
            self::MISCELLANEOUS => 'Miscellaneous',
        };
    }
}