<?php

namespace App\Domain\Auth\Enums;

enum RoleEnum : string
{
    case IRM_ADMIN = 'irm-admin';
    case PRODUCTION_SUPERVISOR = 'production-supervisor';
    case SUPER_ADMIN = 'super-admin';
    case MATERIAL_HANDLER = 'material-handler';

    public function label() : string
    {
        return match ($this) {
            static::IRM_ADMIN => 'IRM Admin',
            static::PRODUCTION_SUPERVISOR => 'Production Supervisor',
            static::SUPER_ADMIN => 'Super Admin',
            static::MATERIAL_HANDLER => 'Material Handler',
        };
    }
}
