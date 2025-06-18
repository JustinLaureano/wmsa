<?php

namespace App\Models\Views;

use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class ViewIrmChemical extends Model
{
    use Filterable,
        Searchable,
        SoftDeletes;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'barcode_label_id';

    /**
     * The table associated with the model.
     */
    protected $table = 'view_irm_chemicals';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'barcode_label_id',
        'part_number',
        'lot_quantity',
        'unit_quantity',
        'material_container_type',
        'assigned_storage_location_name',
        'drop_off_storage_location_name',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'barcode_label_id' => $this->barcode_label_id,
            'part_number' => $this->part_number,
            'assigned_storage_location_name' => $this->assigned_storage_location_name,
            'drop_off_storage_location_name' => $this->drop_off_storage_location_name,
        ];
    }
}
