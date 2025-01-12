<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $uuid,
        public int $organization_id,
        public string|null $domain_account_guid,
        public string|null $teammate_clock_number,
    ) {

    }
}
