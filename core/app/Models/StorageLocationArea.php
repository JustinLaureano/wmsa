<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorageLocationArea extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'building_id',
        'name',
        'description',
        'sap_storage_location_group',
    ];

    /**
     * Get the building for the storage location area.
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }

    /**
     * Get the storage locations for the storage location area.
     */
    public function storageLocations(): HasMany
    {
        return $this->hasMany(StorageLocation::class);
    }

}
