<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'disabled',
        'allocatable',
    ];

    /**
     * Get the area for the storage location.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(StorageLocationArea::class);
    }

    /**
     * Get the location type for the storage location.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(StorageLocationType::class);
    }
}
