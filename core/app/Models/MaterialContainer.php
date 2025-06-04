<?php

namespace App\Models;

use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaterialContainer extends Model
{
    use Filterable, HasFactory, SoftDeletes;

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
        'material_container_type_id',
        'material_tote_type_uuid',
        'movement_status_code',
        'barcode',
        'lot_number',
        'quantity',
        'expiration_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
    ];

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'material_uuid',
        'barcode',
        'quantity',
    ];

    /**
     * Get the events for this container.
     */
    public function events(): HasMany
    {
        return $this->hasMany(ContainerEvent::class, 'material_container_uuid', 'uuid');
    }

    /**
     * Get the material for this container.
     */
    public function material(): HasOne
    {
        return $this->hasOne(Material::class, 'uuid', 'material_uuid');
    }

    /**
     * Get the type for this container.
     */
    public function containerType(): HasOne
    {
        return $this->hasOne(
                MaterialContainerType::class,
                'id',
                'material_container_type_id'
            );
    }

    /**
     * Get the tote type for this container.
     */
    public function materialToteType(): HasOne
    {
        return $this->hasOne(MaterialToteType::class, 'uuid', 'material_tote_type_uuid');
    }

    /**
     * Get the rack location associated with the skid item.
     */
    public function location(): HasOneThrough
    {
        return $this->hasOneThrough(
            StorageLocation::class,
            ContainerLocation::class,
            'material_container_uuid', // container_locations.material_container_uuid
            'uuid', // storage_locations.uuid
            'uuid', // material_containers.uuid
            'storage_location_uuid', // container_locations.storage_location_uuid
        );
    }

    public function requestContainerAllocation(): HasOne
    {
        return $this->hasOne(RequestContainerAllocation::class, 'material_container_uuid', 'uuid');
    }

    /**
     * Get the movement status for this container.
     */
    public function movementStatus(): HasOne
    {
        return $this->hasOne(
                MovementStatus::class,
                'code',
                'movement_status_code'
            );
    }

    /**
     * Scope a query to filter on the barcode column.
     */
    public function scopeWhereBarcode(Builder $query, string $barcode): void
    {
        $query->where('barcode', $barcode);
    }

    /**
     * Scope a query to filter on the uuid column.
     */
    public function scopeWhereUuid(Builder $query, string $uuid): void
    {
        $query->where('uuid', $uuid);
    }

    /**
     * Scope a query to order by expiration date.
     */
    public function scopeOrderByExpiration(Builder $query): void
    {
        $query->orderBy('expiration_date', 'asc');
    }
}
