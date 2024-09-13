<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StorageLocationType extends Model
{
    /**
     * Get the storage locations for the storage location type.
     */
    public function storageLocations(): HasMany
    {
        return $this->hasMany(StorageLocation::class);
    }
}
