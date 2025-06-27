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
            if ($this->isFinance($user)) {
                $user->assignRole(RoleEnum::FINANCE);
            }

            if ($this->isIrmManager($user)) {
                $user->assignRole(RoleEnum::IRM_MANAGER);
            }

            if ($this->isIrmProductionOperator($user)) {
                $user->assignRole(RoleEnum::IRM_PRODUCTION_OPERATOR);
            }

            if ($this->isItAdmin($user)) {
                $user->assignRole(RoleEnum::QUALITY_MANAGER);
            }

            if ($this->isMaterialsControl($user)) {
                $user->assignRole(RoleEnum::MATERIALS_CONTROL);
            }

            if ($this->isMolding($user)) {
                $user->assignRole(RoleEnum::MOLDING);
            }

            if ($this->isProductionManager($user)) {
                $user->assignRole(RoleEnum::PRODUCTION_MANAGER);
            }

            if ($this->isProductionOperator($user)) {
                $user->assignRole(RoleEnum::PRODUCTION_OPERATOR);
            }

            if ($this->isProductionScheduler($user)) {
                $user->assignRole(RoleEnum::PRODUCTION_SCHEDULER);
            }

            if ($this->isProductionShipping($user)) {
                $user->assignRole(RoleEnum::PRODUCTION_SHIPPING);
            }

            if ($this->isProductionSupervisor($user)) {
                $user->assignRole(RoleEnum::PRODUCTION_SUPERVISOR);
            }

            if ($this->isQualityEngineer($user)) {
                $user->assignRole(RoleEnum::QUALITY_ENGINEER);
            }

            if ($this->isQualityManager($user)) {
                $user->assignRole(RoleEnum::QUALITY_MANAGER);
            }

            if ($this->isQualityTechnician($user)) {
                $user->assignRole(RoleEnum::QUALITY_TECHNICIAN);
            }

            if ($this->isShippingClerk($user)) {
                $user->assignRole(RoleEnum::SHIPPING_CLERK);
            }

            if ($this->isShippingSupervisor($user)) {
                $user->assignRole(RoleEnum::SHIPPING_SUPERVISOR);
            }

            if ($this->isSort($user)) {
                $user->assignRole(RoleEnum::SORT);
            }

            if ($this->isTeamLead($user)) {
                $user->assignRole(RoleEnum::TEAM_LEAD);
            }

            if ($this->isTechnicalAdministrator($user)) {
                $user->assignRole(RoleEnum::TECHNICAL_ADMINISTRATOR);
            }

            if ($this->isTooling($user)) {
                $user->assignRole(RoleEnum::TOOLING);
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

    protected function isFinance(User $user) : bool
    {
        return $user->domainAccount?->department === 'Finance';
    }

    protected function isIrmManager(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'IRM Manager',
            'IRM Supervisor'
        ]);
    }

    protected function isIrmProductionOperator(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'IRM Production Operator',
        ]);
    }

    protected function isItAdmin(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Application Developer',
            'IT Administrator'
        ]);
    }

    protected function isMaterialsControl(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Materials Control') ||
            in_array($user->domainAccount?->title, [
                'Materials Manager',
                'Materials Planner',
            ]);
    }

    protected function isMolding(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Mold');
    }

    protected function isProductionManager(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Area Business Manager',
            'Operations Manager',
            'Plant Manager'
        ]);
    }

    protected function isProductionOperator(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Production Paint',
        ]);
    }

    protected function isProductionScheduler(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Production Scheduler',
        ]);
    }

    protected function isProductionShipping(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Production Shipping',
        ]);
    }

    protected function isProductionSupervisor(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Production Supervisor',
        ]);
    }

    protected function isQualityEngineer(User $user) : bool
    {
        return in_array($user->domainAccount?->title, [
            'Quality Engineer',
            'Supplier Quality Engineer',
        ]);
    }

    protected function isQualityManager(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Supplier Quality') ||
            str_contains($user->domainAccount?->title, 'Quality Manager') ||
            in_array($user->domainAccount?->title, [
                'Manager of G.Q.A.S.',
            ]);
    }

    protected function isQualityTechnician(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Lab Tech') ||
            str_contains($user->domainAccount?->title, 'Quality Technician') ||
            str_contains($user->domainAccount?->title, 'Lab Supervisor') ||
            str_contains($user->domainAccount?->title, 'Layout Technician') ||
            in_array($user->domainAccount?->title, [
                'Corporate Document Control',
            ]);
    }

    protected function isShippingClerk(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Billing Clerk') ||
            str_contains($user->domainAccount?->title, 'Shipping Clerk');
    }

    protected function isShippingSupervisor(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Shipping Supervisor') ||
            str_contains($user->domainAccount?->title, 'Logistics Supervisor');
    }

    protected function isSort(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Sort');
    }

    protected function isTeamLead(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Lead');
    }

    protected function isTechnicalAdministrator(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Technical Administrator') ||
            str_contains($user->domainAccount?->title, 'Network Administrator') ||
            str_contains($user->domainAccount?->title, 'Server Administrator');
    }

    protected function isTooling(User $user) : bool
    {
        return str_contains($user->domainAccount?->title, 'Tool');
    }
}
