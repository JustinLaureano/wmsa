<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaterialContainer extends Model
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
        'material_id',
        'material_container_type_id',
        'storage_location_id',
        'movement_status_id',
        'barcode',
        'quantity',
    ];

    /**
     * Get the material for this container.
     */
    public function material(): HasOne
    {
        return $this->hasOne(Material::class, 'material_id', 'id');
    }

    /**
     * Get the type for this container.
     */
    public function containerType(): HasOne
    {
        return $this->hasOne(
                MaterialContainerType::class,
                'material_container_type_id',
                'id'
            );
    }

    /**
     * Get the storage location for this container.
     */
    public function location(): HasOne
    {
        return $this->hasOne(
                StorageLocation::class,
                'storage_location_id',
                'id'
            );
    }

    /**
     * Get the movement status for this container.
     */
    public function movementStatus(): HasOne
    {
        return $this->hasOne(
                MovementStatus::class,
                'movement_status_id',
                'id'
            );
    }
}
