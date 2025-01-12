<?php

namespace Database\Seeders;

use App\Domain\Auth\Enums\RoleEnum;
use App\Models\Teammate;
use App\Models\User;
use App\Repositories\UserRepository;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class ModelHasRoleSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedUsers();
        $this->seedTeammates();
    }

    protected function seedUsers() : void
    {
        $users = (new UserRepository)->get(with: 'domainAccount');

        foreach ($users as $user) {
            if ($this->isIrmManager($user)) {
                $user->assignRole(RoleEnum::IRM_MANAGER);
            }

            if ($this->isItAdmin($user)) {
                $user->assignRole(RoleEnum::QUALITY_MANAGER);
            }

            if ($this->isProductionSupervisor($user)) {
                $user->assignRole(RoleEnum::PRODUCTION_SUPERVISOR);
            }

            if ($this->isQualityManager($user)) {
                $user->assignRole(RoleEnum::QUALITY_MANAGER);
            }
        }
    }

    public function seedTeammates() : void
    {
        $teammates = Teammate::query()->doesntHave('user')->get();

        // TODO: set more production job roles
        foreach ($teammates as $teammate) {
            $teammate->assignRole(RoleEnum::MATERIAL_HANDLER);
        }
    }

    protected function isIrmManager(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'IRM Manager',
            'IRM Supervisor'
        ]);
    }

    protected function isItAdmin(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Application Developer',
            'IT Administrator'
        ]);
    }

    protected function isProductionSupervisor(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Production Supervisor',
        ]);
    }

    protected function isQualityManager(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Quality Manager',
        ]);
    }
}
