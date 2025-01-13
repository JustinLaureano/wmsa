<?php

namespace App\Domain\Materials\Resolvers;

use App\Exceptions\InvalidHandlerException;
use App\Models\User;
use App\Repositories\UserRepository;

class HandlerResolver
{
    public static function getHandler(string $handlerUserUuId) : User | null
    {
        $handler = (new UserRepository)->findBy('uuid', $handlerUserUuId);

        if (!$handler) {
            throw new InvalidHandlerException('The handler does not exist.');
        }

        return $handler;
    }
}
