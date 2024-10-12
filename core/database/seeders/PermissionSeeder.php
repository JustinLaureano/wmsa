<?php

namespace Database\Seeders;

use App\Domain\Auth\Enums\PermissionEnum;
use App\Models\Permission;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [];

        foreach (PermissionEnum::cases() as $permission) {
            $roles[] = array_merge([
                'name' => $permission->value,
                'guard_name' => 'web'
            ], $this->getTimestamps());
        }

        Permission::insert($roles);
    }
}
