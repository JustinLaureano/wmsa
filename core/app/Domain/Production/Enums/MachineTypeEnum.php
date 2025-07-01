<?php

namespace App\Domain\Production\Enums;

enum MachineTypeEnum: string
{
    case ASSEMBLY = 'assembly';
    case PRESS = 'press';

    public function label(): string
    {
        return match($this) {
            self::ASSEMBLY => __('frontend.assembly'),
            self::PRESS => __('frontend.press'),
        };
    }
}
