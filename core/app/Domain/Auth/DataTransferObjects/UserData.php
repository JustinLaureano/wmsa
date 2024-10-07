<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $guid,
        public int $organization_id,
        public string $username,
        public string $first_name,
        public string $last_name,
        public string $display_name,
        public string $title,
        public string $description,
        public string $department,
        public string $email
    ) {

    }
}
