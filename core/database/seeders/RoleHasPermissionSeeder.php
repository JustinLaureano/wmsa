<?php

namespace Database\Seeders;

use App\Domain\Auth\Access\RolePermissionsProvider;
use App\Domain\Auth\DataTransferObjects\AssignRolePermissionData;
use App\Repositories\RoleRepository;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleRepository = new RoleRepository;

        $rolePermissions = RolePermissionsProvider::toArray();

        foreach ($rolePermissions as $rp) {
            foreach ($rp->permissions as $permissionName) {
                $roleRepository->assignPermission(
                    new AssignRolePermissionData(
                        role: $roleRepository->findByName($rp->name),
                        permission: $permissionName
                    )
                );
            }
        }
    }
}
