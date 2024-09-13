<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorageLocationType extends Model
{
    use SoftDeletes;

    /**
     * Get the storage locations for the storage location type.
     */
    public function storageLocations(): HasMany
    {
        return $this->hasMany(StorageLocation::class);
    }
}
