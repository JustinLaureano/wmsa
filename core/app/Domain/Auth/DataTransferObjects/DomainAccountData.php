<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\LaravelData\Data;

class DomainAccountData extends Data
{
    public function __construct(
        public string $guid,
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
