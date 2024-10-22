<?php

namespace App\Domain\Messaging\Contracts;

interface MessengerContract
{
    public function getMessengerId() : string;
}
