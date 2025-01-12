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
        $permissions = [];

        foreach (PermissionEnum::cases() as $permission) {
            $permissions[] = array_merge([
                'name' => $permission->value,
                'guard_name' => 'web'
            ], $this->getTimestamps());
        }

        Permission::insert($permissions);
    }
}
