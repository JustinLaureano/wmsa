<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialContainer;
use Illuminate\Database\Seeder;

class MaterialContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialContainer::factory(600)->create();

        if (app()->isLocal()) {
            MaterialContainer::factory(4)->create([
                'material_uuid' => Material::where('part_number', '444444')->first()->uuid,
            ]);

            MaterialContainer::factory(4)->create([
                'material_uuid' => Material::where('part_number', '555555')->first()->uuid,
            ]);
        }
    }
}
