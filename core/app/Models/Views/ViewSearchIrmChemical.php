<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSearchIrmChemical extends Model
{
    use Searchable;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'irm_chemical_uuid';

    /**
     * The table associated with the model.
     */
    protected $table = 'view_search_irm_chemicals';

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'material_number' => $this->material_number,
            'part_number' => $this->part_number,
            'description' => $this->description,
        ];
    }
}
