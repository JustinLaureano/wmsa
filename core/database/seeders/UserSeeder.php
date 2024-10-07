<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = Organization::query()
            ->orderBy('id', 'ASC')
            ->first();

        User::factory()->create([
            'organization_id' => $organization->id,
            'username' => 'bmsmith',
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'display_name' => 'Smith, Bob',
            'title' => 'Materials Manager',
            'description' => 'Materials Manager',
            'email' => 'bmsmith@acme.com',
        ]);

        User::factory()->create([
            'organization_id' => $organization->id,
            'username' => 'tpwilson',
            'first_name' => 'Tom',
            'last_name' => 'Wilson',
            'display_name' => 'Wilson, Tom',
            'title' => 'Quality Manager',
            'description' => 'Quality Manager',
            'email' => 'tpwilson@acme.com',
        ]);
    }
}
