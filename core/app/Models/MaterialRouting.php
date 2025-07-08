<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaterialRouting extends Model
{
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'material_routing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_uuid',
        'route_building_id',
        'sequence',
        'storage_location_area_id',
        'is_preferred',
        'fallback_order',
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
     * Get the material that this routing rule applies to.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_uuid', 'uuid');
    }

    /**
     * Get the building that this routing rule applies to.
     */
    public function routeBuilding(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'route_building_id', 'id');
    }

    /**
     * Get the storage location area that this routing rule applies to.
     */
    public function storageLocationArea(): BelongsTo
    {
        return $this->belongsTo(StorageLocationArea::class);
    }
}
