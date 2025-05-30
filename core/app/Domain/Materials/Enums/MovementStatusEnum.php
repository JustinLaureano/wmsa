<?php

namespace App\Domain\Materials\Enums;

enum MovementStatusEnum: string
{
    case UNRESTRICTED = 'unrestricted';
    case RESTRICTED = 'restricted';
    case QUARANTINE = 'quarantine';
    case INSPECTION_HOLD = 'inspection-hold';
    case QUALITY_CHECK = 'quality-check';

    public function label(): string
    {
        return match ($this) {
            self::UNRESTRICTED => 'Unrestricted',
            self::RESTRICTED => 'Restricted',
            self::QUARANTINE => 'Quarantine',
            self::INSPECTION_HOLD => 'Inspection Hold',
            self::QUALITY_CHECK => 'Quality Check',
        };
    }
}
