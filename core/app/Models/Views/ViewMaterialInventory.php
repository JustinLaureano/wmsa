<?php

namespace App\Models\Views;

use App\Support\Eloquent\Filter\Filterable;
use App\Models\ContainerEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class ViewMaterialInventory extends Model
{
    use Filterable,
        Searchable;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_material_inventory';

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
        'lot_number',
        'material_number',
        'part_number',
        'material_description',
        'base_unit_of_measure',
        'container_type_name',
        'movement_status_name',
        'storage_location_name',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'material_uuid' => $this->material_uuid,
            'barcode' => $this->barcode,
            'quantity' => $this->quantity,
            'lot_number' => $this->lot_number,
            'material_number' => $this->material_number,
            'part_number' => $this->part_number,
            'material_description' => $this->material_description,
            'base_unit_of_measure' => $this->base_unit_of_measure,
            'container_type_name' => $this->container_type_name,
            'movement_status_name' => $this->movement_status_name,
            'storage_location_name' => $this->storage_location_name,
        ];
    }

    /**
     * Get the events for this container.
     */
    public function events(): HasMany
    {
        return $this->hasMany(ContainerEvent::class, 'material_container_uuid', 'uuid');
    }
}
