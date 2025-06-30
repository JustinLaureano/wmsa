<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterialContainer;
use Illuminate\Support\Collection;

class ViewSearchMaterialContainerRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchMaterialContainer::search($query)
            ->take($limit)
            ->get()
            ->map(function($container) {
                $container->search_type = 'material_container';
                return $container;
            });
    }
}
