<?php

namespace App\Domain\Materials\Enums;

use App\Support\Enums\Arrayable;

enum HandlerTypeEnum: string
{
    use Arrayable;

    case TEAMMATE = 'teammate';
}
