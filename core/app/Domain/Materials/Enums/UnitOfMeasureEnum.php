<?php

namespace App\Domain\Materials\Enums;

enum UnitOfMeasureEnum: string
{
    case BAG = 'bag';
    case BIN = 'bin';
    case BRL = 'brl';
    case CONT = 'cont';
    case EA = 'ea';
    case KG = 'kg';
    case L = 'l';
    case M = 'm';
    case OZ = 'oz';
    case LB = 'lb';
    case PAL = 'pal';
    case PCS = 'pcs';
    case SKID = 'skd';
    case TOTE = 'tote';

    public function label(): string
    {
        return match($this) {
            self::BAG => 'Bag',
            self::BIN => 'Bin',
            self::BRL => 'Barrel',
            self::CONT => 'Container',
            self::EA => 'Each',
            self::KG => 'Kilogram',
            self::L => 'Liter',
            self::M => 'Meter',
            self::OZ => 'Ounce',
            self::LB => 'Pound',
            self::PAL => 'Pallet',
            self::PCS => 'Pieces',
            self::SKID => 'Skid',
            self::TOTE => 'Tote',
        };
    }

    public function abbreviationLabel(): string
    {
        return match($this) {
            self::BAG => 'Bag',
            self::BIN => 'Bin',
            self::BRL => 'Barrel',
            self::CONT => 'Container',
            self::EA => 'Ea',
            self::KG => 'Kg',
            self::L => 'L',
            self::M => 'M',
            self::OZ => 'Oz',
            self::LB => 'Lb',
            self::PAL => 'Pal',
            self::PCS => 'Pcs',
            self::SKID => 'Skid',
            self::TOTE => 'Tote',
        };
    }

    public function pluralAbbreviationLabel(): string
    {
        return match($this) {
            self::BAG => 'Bags',
            self::BIN => 'Bins',
            self::BRL => 'Barrels',
            self::CONT => 'Containers',
            self::EA => 'Ea',
            self::KG => 'Kgs',
            self::L => 'Lts',
            self::M => 'Ms',
            self::OZ => 'Oz',
            self::LB => 'Lbs',
            self::PAL => 'Pallets',
            self::PCS => 'Pieces',
            self::SKID => 'Skids',
            self::TOTE => 'Totes',
        };
    }
}