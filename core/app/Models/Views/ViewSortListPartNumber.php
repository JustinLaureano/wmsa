<?php

namespace App\Models\Views;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ViewSortListPartNumber extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'view_sort_list_part_numbers';

    /**
     * Get the material for the sort list part number.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'part_number', 'part_number');
    }
}
