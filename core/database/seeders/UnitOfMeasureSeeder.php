<?php

namespace Database\Seeders;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Models\UnitOfMeasure;
use Illuminate\Database\Seeder;

class UnitOfMeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (UnitOfMeasureEnum::cases() as $case) {
            UnitOfMeasure::create([
                'unit_of_measure' => $case->value,
                'description' => UnitOfMeasureEnum::from($case->value)->label(),
            ]);
        }
    }
}