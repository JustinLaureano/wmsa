<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaterialRequest extends Model
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
        'material_uuid',
        'quantity',
        'unit_of_measure',
        'machine_uuid',
        'storage_location_uuid',
        'material_request_status_code',
        'requester_user_uuid',
        'requested_at'
    ];

    /**
     * Get the machine for this request.
     */
    public function machine(): HasOne
    {
        return $this->hasOne(Machine::class, 'machine_uuid', 'uuid');
    }

    /**
     * Get the material for this request.
     */
    public function material(): HasOne
    {
        return $this->hasOne(Material::class, 'material_uuid', 'uuid');
    }

    /**
     * Get the status for this request.
     */
    public function status(): HasOne
    {
        return $this->hasOne(MaterialRequestStatus::class, 'material_request_status_code', 'code');
    }

    /**
     * Get the storage location for this request.
     */
    public function storageLocation(): HasOne
    {
        return $this->hasOne(StorageLocation::class, 'storage_location_uuid', 'uuid');
    }

    /**
     * Get the requester for this request.
     */
    public function requester(): HasOne
    {
        return $this->hasOne(User::class, 'requester_user_uuid', 'uuid');
    }
}
