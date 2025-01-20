<?php

namespace App\Domain\Production\Resolvers;

use App\Exceptions\InvalidHandlerException;
use App\Models\User;
use App\Repositories\UserRepository;

class RequesterResolver
{
    public static function getRequester(string $requesterUserUuId) : User | null
    {
        $requester = (new UserRepository)->findBy('uuid', $requesterUserUuId);

        if (!$requester) {
            throw new InvalidHandlerException('The requester does not exist.');
        }

        return $requester;
    }
}
