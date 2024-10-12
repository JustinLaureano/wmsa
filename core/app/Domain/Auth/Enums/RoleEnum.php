<?php

namespace App\Domain\Auth\Enums;

enum RoleEnum : string
{
    case IRM_MANAGER = 'irm-manager';
    case MATERIAL_HANDLER = 'material-handler';
    case PRODUCTION_SUPERVISOR = 'production-supervisor';
    case QUALITY_MANAGER = 'quality-manager';
    case SUPER_ADMIN = 'super-admin';

    public function label() : string
    {
        return match ($this) {
            static::IRM_MANAGER => 'IRM Manager',
            static::MATERIAL_HANDLER => 'Material Handler',
            static::PRODUCTION_SUPERVISOR => 'Production Supervisor',
            static::QUALITY_MANAGER => 'Quality Manager',
            static::SUPER_ADMIN => 'Super Admin',
        };
    }
}
