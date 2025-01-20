<?php

namespace Database\Seeders;

use App\Models\MaterialRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: implement this seeder
        MaterialRequest::factory()->count(10)->create();
    }
}
