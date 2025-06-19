<?php

namespace App\Repositories;

use App\Models\IrmChemical;
use Illuminate\Database\Eloquent\Collection;

class IrmChemicalRepository
{
    /**
     * Get all delivery documents.
     */
    public function getInventory(): Collection
    {
        return IrmChemical::query()
            ->with('inventory', 'material')
            ->orderBy('id', 'asc')
            ->get();
    }
}