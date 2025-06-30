<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterial;
use Illuminate\Database\Eloquent\Collection;

class ViewSearchMaterialRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchMaterial::search($query)
            ->take($limit)
            ->get()
            ->map(function ($material) {
                $material->search_type = 'material';
                $material->url = route('materials.show', $material->material_uuid);
                return $material;
            });
    }
}
