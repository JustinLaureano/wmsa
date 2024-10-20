<?php

namespace App\Domain\Materials\Resolvers;

use App\Domain\Materials\Contracts\HandlerContract;
use App\Domain\Materials\Enums\HandlerTypeEnum;
use App\Exceptions\InvalidHandlerTypeException;
use App\Repositories\TeammateRepository;

class HandlerResolver
{
    public static function getHandler(string $type, string $handlerId) : HandlerContract | null
    {
        if ($type === HandlerTypeEnum::TEAMMATE->value) {
            return (new TeammateRepository)->findByClockNumber($handlerId);
        }
        else {
            throw new InvalidHandlerTypeException('The handler type '. $type .' does not exist.');
        }
    }
}
