<?php

namespace App\Domain\Materials\Enums;

enum MovementStatusEnum: string
{
    case UNRESTRICTED = 'unrestricted';
    case RESTRICTED = 'restricted';
    case QUARANTINE = 'quarantine';
    case INSPECTION_HOLD = 'inspection-hold';
    case QUALITY_CHECK = 'quality-check';
}
