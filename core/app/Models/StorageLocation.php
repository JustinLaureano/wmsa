<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class StorageLocation extends Model
{
    use HasFactory, SoftDeletes;

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
        'storage_location_area_id',
        'storage_location_type_id',
        'barcode',
        'max_containers',
        'restrict_request_allocations',
        'disabled',
        'reservable',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the area for the storage location.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(StorageLocationArea::class, 'storage_location_area_id', 'id');
    }

    /**
     * Get the containers for the storage location.
     */
    public function containers(): HasManyThrough
    {
        return $this->hasManyThrough(
            MaterialContainer::class,
            ContainerLocation::class,
            'storage_location_uuid', // container_locations.storage_location_uuid
            'uuid', // storage_locations.uuid
            'uuid', // material_containers.uuid
            'material_container_uuid', // container_locations.material_container_uuid
        );
    }

    /**
     * Get the location type for the storage location.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(StorageLocationType::class, 'storage_location_type_id', 'id');
    }

    /**
     * Scope a query to filter on the uuid column.
     */
    public function scopeWhereUuid(Builder $query, string $uuid): void
    {
        $query->where('uuid', $uuid);
    }

    public function scopeWhereBarcode(Builder $query, string $barcode): void
    {
        $query->where('barcode', $barcode);
    }
}
