<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
