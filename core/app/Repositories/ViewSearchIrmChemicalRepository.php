<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchIrmChemical;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchIrmChemicalRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_irm_chemical_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchIrmChemical::search($query)
                    ->take($limit)
                    ->get()
                    ->map(function ($chemical) {
                        $chemical->key = $chemical->irm_chemical_uuid;
                        $chemical->primary_text = $chemical->part_number;
                        $chemical->secondary_text = $chemical->description;
                        $chemical->search_type = 'irm_chemical';
                        $chemical->url = route('irm.chemicals.show', $chemical->irm_chemical_uuid);
                        return $chemical;
                    });
            });
    }
}
