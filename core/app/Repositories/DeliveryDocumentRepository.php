<?php

namespace App\Repositories;

use App\Models\DeliveryDocument;
use Illuminate\Database\Eloquent\Collection;

class DeliveryDocumentRepository
{
    /**
     * Get all delivery documents.
     */
    public function get(): Collection
    {
        return DeliveryDocument::query()
            ->latest()
            ->get();
    }
}