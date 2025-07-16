<?php

namespace App\Repositories;

use App\Models\MaterialContainer;
use App\Models\MaterialToteType;

class MaterialToteTypeRepository
{
    /**
     * Get messages for a conversation.
     */
    public function isToyotaToteContainer(MaterialContainer $container): bool
    {
        return MaterialToteType::query()
            ->where('material_uuid', $container->material_uuid)
            ->where('uuid', $container->material_tote_type_uuid)
            ->where('tote', 'LIKE', '%Toyota%')
            ->exists();
    }
}
