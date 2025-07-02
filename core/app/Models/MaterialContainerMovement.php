<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MaterialContainerMovement extends Model
{
    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_container_uuid',
        'storage_location_uuid',
        'sequence',
        'is_sort_location',
        'moved_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the material container that this movement belongs to.
     */
    public function materialContainer(): BelongsTo
    {
        return $this->belongsTo(MaterialContainer::class, 'material_container_uuid', 'uuid');
    }

    /**
     * Get the storage location that this movement belongs to.
     */
    public function storageLocation(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class, 'storage_location_uuid', 'uuid');
    }
}
