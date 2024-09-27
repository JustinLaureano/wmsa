<?php

namespace App\Support;

use App\Models\InventoryAuditor;

class ClockNumber
{
    public static function getRandomMaterialHandler() : string
    {
        return InventoryAuditor::inRandomOrder()->value('clock_number');
    }
}
