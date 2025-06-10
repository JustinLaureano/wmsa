<?php

namespace App\Models\Views;

use App\Models\Material;
use App\Models\SortListCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewSortList extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_sort_list';

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
     * Get the customer for the sort list.
     */
    public function customer(): HasOne
    {
        return $this->hasOne(SortListCustomer::class, 'uuid', 'sort_list_customer_uuid');
    }

    /**
     * Get the material for the sort list part number.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'part_number', 'part_number');
    }
}
