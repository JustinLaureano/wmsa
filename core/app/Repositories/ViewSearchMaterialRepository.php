<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchMaterialRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_material_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchMaterial::search($query)
                    ->take($limit)
                    ->get()
                    ->map(function ($material) {
                        $material->key = $material->material_uuid;
                        $material->primary_text = $material->part_number;
                        $material->secondary_text = $material->description;
                        $material->search_type = 'material';
                        $material->url = route('materials.show', $material->material_uuid);
                        return $material;
                    });
        });
    }
}
