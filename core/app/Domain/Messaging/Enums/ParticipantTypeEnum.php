<?php

namespace App\Domain\Messaging\Enums;

use App\Support\Enums\Arrayable;

enum ParticipantTypeEnum: string
{
    use Arrayable;

    case USER = 'user';
    case TEAMMATE = 'teammate';
}
