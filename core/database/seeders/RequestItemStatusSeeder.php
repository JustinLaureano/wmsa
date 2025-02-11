<?php

namespace Database\Seeders;

use App\Domain\Production\Enums\RequestItemStatusEnum;
use App\Models\RequestItemStatus;
use Illuminate\Database\Seeder;

class RequestItemStatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach (RequestItemStatusEnum::cases() as $status) {
            RequestItemStatus::create([
                'code' => $status->value,
                'name' => $status->label(),
                'description' => $status->description(),
            ]);
        }
    }
}
