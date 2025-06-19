<?php

namespace App\Domain\Materials\Enums;

enum MaterialTypeEnum: string
{
    case RAW_MATERIALS = 'raw-materials';
    case IRM = 'irm';
    case COMPOUND = 'compound';
    case CEMENTED_METAL = 'cemented-metal';
    case SEMI_FINISHED_GOODS = 'semi-finished-goods';
    case FINISHED_GOODS = 'finished-goods';
    case PACKAGING_MATERIALS = 'packaging-materials';
    case MISCELLANEOUS = 'miscellaneous';

    public function code(): string
    {
        return match($this) {
            self::RAW_MATERIALS => 'RAW',
            self::IRM => 'IRM',
            self::COMPOUND => 'COMP',
            self::CEMENTED_METAL => 'CMET',
            self::SEMI_FINISHED_GOODS => 'SEMI',
            self::FINISHED_GOODS => 'FG',
            self::PACKAGING_MATERIALS => 'CBP',
            self::MISCELLANEOUS => 'MISC',
        };
    }

    public function label(): string
    {
        return match($this) {
            self::RAW_MATERIALS => 'Raw Materials',
            self::IRM => 'IRM Chemicals',
            self::COMPOUND => 'Compound',
            self::CEMENTED_METAL => 'Cemented Metal',
            self::SEMI_FINISHED_GOODS => 'Semi-Finished Goods',
            self::FINISHED_GOODS => 'Finished Goods',
            self::PACKAGING_MATERIALS => 'Packaging Materials',
            self::MISCELLANEOUS => 'Miscellaneous',
        };
    }
}