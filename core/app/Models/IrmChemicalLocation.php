<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IrmChemicalLocation extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'irm_chemical_uuid',
        'storage_location_uuid',
        'quantity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the IRM chemical for this chemical location.
     */
    public function irmChemical(): BelongsTo
    {
        return $this->belongsTo(IrmChemical::class, 'irm_chemical_uuid', 'uuid');
    }

    /**
     * Get the storage location for this chemical location.
     */
    public function storageLocation(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class, 'storage_location_uuid', 'uuid');
    }
}
