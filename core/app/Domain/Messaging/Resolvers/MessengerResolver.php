<?php

namespace App\Domain\Messaging\Resolvers;

use App\Domain\Materials\Contracts\HandlerContract;
use App\Domain\Messaging\Enums\SenderTypeEnum;
use App\Exceptions\InvalidHandlerTypeException;
use App\Repositories\TeammateRepository;
use App\Repositories\UserRepository;

class MessengerResolver
{
    public static function getMessenger(string $type, string $handlerId) : HandlerContract | null
    {
        if ($type === SenderTypeEnum::TEAMMATE->value) {
            return (new TeammateRepository)->findByClockNumber($handlerId);
        }
        else if ($type === SenderTypeEnum::USER->value) {
            return (new UserRepository)->findBy('uuid', $handlerId);
        }
        else {
            throw new InvalidHandlerTypeException('The messenger type '. $type .' does not exist.');
        }
    }
}
