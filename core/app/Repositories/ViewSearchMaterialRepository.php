<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterial;
use Illuminate\Database\Eloquent\Collection;

class ViewSearchMaterialRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchMaterial::query()
            ->search($query)
            ->take($limit)
            ->get()
            ->map(function ($material) {
                $material->search_type = 'material';
                return $material;
            });
    }
}
