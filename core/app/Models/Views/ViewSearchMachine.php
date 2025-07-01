<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViewSearchMachine extends Model
{
    use Searchable;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'machine_uuid';

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
    protected $table = 'view_search_machines';

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'machine_name' => $this->machine_name,
        ];
    }
}
