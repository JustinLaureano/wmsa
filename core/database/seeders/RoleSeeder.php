<?php

namespace Database\Seeders;

use App\Domain\Auth\Enums\RoleEnum;
use App\Models\Role;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [];

        foreach (RoleEnum::cases() as $role) {
            $roles[] = array_merge([
                'name' => $role->value,
                'guard_name' => 'web'
            ], $this->getTimestamps());
        }

        Role::insert($roles);
    }
}
