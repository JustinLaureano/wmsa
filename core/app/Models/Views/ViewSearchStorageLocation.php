<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSearchStorageLocation extends Model
{
    use Searchable;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'storage_location_uuid';

    /**
     * The table associated with the model.
     */
    protected $table = 'view_search_storage_locations';

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'barcode' => $this->barcode,
        ];
    }
}
