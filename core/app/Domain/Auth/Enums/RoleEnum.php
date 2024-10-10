<?php

namespace App\Domain\Auth\Enums;

enum RoleEnum : string
{
    case SUPER_ADMIN = 'super-admin';
    case MATERIAL_HANDLER = 'material-handler';

    public function label() : string
    {
        return match ($this) {
            static::SUPER_ADMIN => 'Super Admin',
            static::MATERIAL_HANDLER => 'Material Handler',
        };
    }
}
