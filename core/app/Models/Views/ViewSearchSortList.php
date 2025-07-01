<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSearchSortList extends Model
{
    use Searchable;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'sort_list_uuid';

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
    protected $table = 'view_search_sort_list';

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'part_number' => $this->part_number,
            'material_description' => $this->material_description,
        ];
    }
}
