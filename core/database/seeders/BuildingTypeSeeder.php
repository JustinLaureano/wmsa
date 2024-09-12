<?php

namespace Database\Seeders;

use App\Models\BuildingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BuildingType::factory()->create([
            'name' => 'factory',
            'description' => 'produces materials'
        ]);

        BuildingType::factory()->create([
            'name' => 'warehouse',
            'description' => 'storage for materials'
        ]);

        BuildingType::factory()->create([
            'name' => 'offsite warehouse',
            'description' => 'offsite storage for materials'
        ]);
    }
}
