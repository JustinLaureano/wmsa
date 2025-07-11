<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class IrmChemical extends Model
{
    use HasFactory,
        HasUuids,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'uuid',
        'material_uuid',
        'lot_quantity',
        'unit_quantity',
        'assigned_storage_location_uuid',
        'drop_off_storage_location_uuid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'material_uuid',
        'assigned_storage_location_uuid',
        'drop_off_storage_location_uuid',
    ];

    /**
     * Get the material for this chemical.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_uuid', 'uuid');
    }

    /**
     * Get the inventory for this chemical.
     */
    public function inventory(): HasMany
    {
        return $this->hasMany(IrmChemicalLocation::class, 'irm_chemical_uuid', 'uuid');
    }

    /**
     * Get the assigned storage location for this chemical.
     */
    public function assignedStorageLocation(): HasOne
    {
        return $this->hasOne(StorageLocation::class, 'uuid', 'assigned_storage_location_uuid');
    }

    /**
     * Get the drop off storage location for this chemical.
     */
    public function dropOffStorageLocation(): HasOne
    {
        return $this->hasOne(StorageLocation::class, 'uuid', 'drop_off_storage_location_uuid');
    }
}
