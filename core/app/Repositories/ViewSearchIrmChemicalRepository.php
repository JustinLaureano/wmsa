<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchIrmChemical;
use Illuminate\Database\Eloquent\Collection;

class ViewSearchIrmChemicalRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchIrmChemical::search($query)
            ->take($limit)
            ->get()
            ->map(function ($chemical) {
                $chemical->search_type = 'irm_chemical';
                return $chemical;
            });
    }
}
