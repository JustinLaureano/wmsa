<?php

namespace App\Domain\Auth\Enums;

enum RoleEnum : string
{
    case FINANCE = 'finance';
    case IRM_MANAGER = 'irm-manager';
    case IRM_PRODUCTION_OPERATOR = 'irm-production-operator';
    case IT_ADMINISTRATOR = 'it-administrator';
    case MATERIALS_CONTROL = 'materials-control';
    case MATERIAL_HANDLER = 'material-handler';
    case MOLDING = 'molding';
    case PRODUCTION_MANAGER = 'production-manager';
    case PRODUCTION_OPERATOR = 'production-operator';
    case PRODUCTION_SCHEDULER = 'production-scheduler';
    case PRODUCTION_SHIPPING = 'production-shipping';
    case PRODUCTION_SUPERVISOR = 'production-supervisor';
    case QUALITY_ENGINEER = 'quality-engineer';
    case QUALITY_MANAGER = 'quality-manager';
    case QUALITY_TECHNICIAN = 'quality-technician';
    case SHIPPING_CLERK = 'shipping-clerk';
    case SHIPPING_SUPERVISOR = 'shipping-supervisor';
    case SORT = 'sort';
    case SUPER_ADMIN = 'super-admin';
    case TEAM_LEAD = 'team-lead';
    case TECHNICAL_ADMINISTRATOR = 'technical-administrator';
    case TOOLING = 'tooling';

    public function label() : string
    {
        return match ($this) {
            static::FINANCE => __('frontend.finance'),
            static::IRM_MANAGER => __('frontend.irm_manager'),
            static::IRM_PRODUCTION_OPERATOR => __('frontend.irm_production_operator'),
            static::IT_ADMINISTRATOR => __('frontend.it_administrator'),
            static::MATERIALS_CONTROL => __('frontend.materials_control'),
            static::MATERIAL_HANDLER => __('frontend.material_handler'),
            static::MOLDING => __('frontend.molding'),
            static::PRODUCTION_MANAGER => __('frontend.production_manager'),
            static::PRODUCTION_OPERATOR => __('frontend.production_operator'),
            static::PRODUCTION_SCHEDULER => __('frontend.production_scheduler'),
            static::PRODUCTION_SHIPPING => __('frontend.production_shipping'),
            static::PRODUCTION_SUPERVISOR => __('frontend.production_supervisor'),
            static::QUALITY_ENGINEER => __('frontend.quality_engineer'),
            static::QUALITY_MANAGER => __('frontend.quality_manager'),
            static::QUALITY_TECHNICIAN => __('frontend.quality_technician'),
            static::SHIPPING_CLERK => __('frontend.shipping_clerk'),
            static::SHIPPING_SUPERVISOR => __('frontend.shipping_supervisor'),
            static::SORT => __('frontend.sort'),
            static::SUPER_ADMIN => __('frontend.super_admin'),
            static::TEAM_LEAD => __('frontend.team_lead'),
            static::TECHNICAL_ADMINISTRATOR => __('frontend.technical_administrator'),
            static::TOOLING => __('frontend.tooling'),
        };
    }
}
