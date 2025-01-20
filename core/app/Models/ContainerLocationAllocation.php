<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ContainerLocationAllocation extends Model
{
    use HasFactory;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->ulid = Str::ulid();
            $model->occurred_at = now();
        });
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'storage_location_uuid',
        'material_container_uuid',
        'occurred_at',
    ];

    /**
     * Get the container for this allocation.
     */
    public function materialContainer(): BelongsTo
    {
        return $this->belongsTo(MaterialContainer::class, 'material_container_uuid', 'uuid');
    }

    /**
     * Get the location for this allocation.
     */
    public function storageLocation(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class, 'storage_location_uuid', 'uuid');
    }
}
