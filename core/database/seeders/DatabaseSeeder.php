<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Part;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Bob Smith',
            'email' => 'bob@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'Tom Wilson',
            'email' => 'tom@gmail.com',
        ]);

        Part::factory(5)->create();

        Location::factory(10)->create();
    }
}
