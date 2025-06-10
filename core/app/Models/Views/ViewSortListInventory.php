<?php

namespace App\Models\Views;

use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSortListInventory extends Model
{
    use Filterable,
        Searchable;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_sort_list_inventory';

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'barcode',
        'lot_number',
        'quantity',
        'part_number',
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
            'storage_location_name' => $this->storage_location_name,
        ];
    }
}
