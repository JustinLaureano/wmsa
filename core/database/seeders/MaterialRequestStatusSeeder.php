<?php

namespace Database\Seeders;

use App\Models\MaterialRequestStatus;
use Illuminate\Database\Seeder;

class MaterialRequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialRequestStatus::factory()->create([
            'code' => 'OPEN',
            'name' => 'Open',
            'description' => 'Request unfulfilled'
        ]);

        MaterialRequestStatus::factory()->create([
            'code' => 'COMPLETED',
            'name' => 'Completed',
            'description' => 'Request fulfilled'
        ]);

        MaterialRequestStatus::factory()->create([
            'code' => 'CANCELLED',
            'name' => 'Cancelled',
            'description' => 'Request cancelled'
        ]);
    }
}
