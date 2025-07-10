<?php

namespace App\Models\Views;

use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSortLocationInventory extends Model
{
    use Filterable,
        Searchable;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_sort_location_inventory';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'material_container_uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'material_uuid',
        'barcode',
        'lot_number',
        'quantity',
        'part_number',
        'storage_location_area_name',
        'storage_location_building_id',
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
            'barcode' => $this->barcode,
            'lot_number' => $this->lot_number,
            'quantity' => $this->quantity,
            'part_number' => $this->part_number,
            'storage_location_area_name' => $this->storage_location_area_name,
            'storage_location_name' => $this->storage_location_name,
        ];
    }
}
