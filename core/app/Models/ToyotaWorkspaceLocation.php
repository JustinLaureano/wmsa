<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToyotaWorkspaceLocation extends Model
{
    use HasUuids, SoftDeletes;

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
        'material_uuid',
        'storage_location_uuid',
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
     * Get the material for this workspace location.
     */
    public function material(): HasOne
    {
        return $this->hasOne(Material::class, 'uuid', 'material_uuid');
    }

    /**
     * Get the location for this workspace.
     */
    public function storageLocation(): HasOne
    {
        return $this->hasOne(StorageLocation::class, 'uuid', 'storage_location_uuid');
    }
}
