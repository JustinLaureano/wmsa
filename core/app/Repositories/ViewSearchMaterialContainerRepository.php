<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterialContainer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchMaterialContainerRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_material_container_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchMaterialContainer::search($query)
                    ->take($limit)
                    ->get()
                    ->map(function($container) {
                        $container->key = $container->material_container_uuid;
                        $container->primary_text = 'PN: '.
                            $container->part_number .' LN: '.
                            $container->lot_number .' Qty: '.
                            $container->quantity;
                        $container->secondary_text = 'Location: '. $container->storage_location_name;
                        $container->search_type = 'material_container';
                        $container->url = route('containers.show', $container->material_container_uuid);
                        return $container;
                    });
        });
    }
}
