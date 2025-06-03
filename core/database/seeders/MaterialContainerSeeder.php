<?php

namespace Database\Seeders;

use App\Models\MaterialContainer;
use Illuminate\Database\Seeder;

class MaterialContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialContainer::factory(2000)->create();
    }
}
