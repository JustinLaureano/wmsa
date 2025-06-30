<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSearchMaterialContainer extends Model
{
    use Searchable;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'material_container_uuid';

    /**
     * The key type for the model.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_search_material_containers';

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            // 'material_number' => $this->material_number,
            'part_number' => $this->part_number,
            'barcode' => $this->barcode,
            'lot_number' => $this->lot_number,
            'quantity' => $this->quantity,
            'storage_location_name' => $this->storage_location_name,
            'storage_location_area_name' => $this->storage_location_area_name,
        ];
    }
}
