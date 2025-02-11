<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaterialRequestItem extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    protected $fillable = [
        'material_request_uuid',
        'material_uuid',
        'quantity_requested',
        'quantity_delivered',
        'unit_of_measure',
        'machine_uuid',
        'storage_location_uuid',
        'request_item_status_code'
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
     * Get the material request for this item.
     */
    public function materialRequest()
    {
        return $this->belongsTo(MaterialRequest::class, 'material_request_uuid', 'uuid');
    }

    /**
     * Get the material for this item.
     */
    public function material(): HasOne
    {
        return $this->hasOne(Material::class, 'uuid', 'material_uuid');
    }

    /**
     * Get the machine for this item.
     */
    public function machine(): HasOne
    {
        return $this->hasOne(Machine::class, 'uuid', 'machine_uuid');
    }

    /**
     * Get the storage location for this item.
     */
    public function storageLocation(): HasOne
    {
        return $this->hasOne(StorageLocation::class, 'uuid', 'storage_location_uuid');
    }

    /**
     * Get the status for this item.
     */
    public function status(): HasOne
    {
        return $this->hasOne(RequestItemStatus::class, 'code', 'request_item_status_code');
    }

    /**
     * Get the container allocation for this request.
     */
    public function containerAllocation(): HasOneThrough
    {
        return $this->hasOneThrough(
            MaterialContainer::class,
            RequestContainerAllocation::class,
            'material_request_item_uuid',
            'uuid',
            'uuid',
            'material_container_uuid'
        );
    }
}
