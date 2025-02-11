<?php

namespace Database\Seeders;

use App\Domain\Production\Enums\RequestTypeEnum;
use App\Models\MaterialRequestType;
use Illuminate\Database\Seeder;

class MaterialRequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RequestTypeEnum::cases() as $case) {
            MaterialRequestType::create([
                'code' => $case->value,
                'name' => $case->label(),
                'description' => $case->description()
            ]);
        }
    }
}
