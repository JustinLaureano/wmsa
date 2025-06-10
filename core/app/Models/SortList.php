<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SortList extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'sort_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort_list_customer_uuid',
        'material_uuid',
        'type',
        'status',
        'reason',
        'percent',
        'standard_time',
        'cert',
        'line_side_sort',
        'list_date',
        'close_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the customer that the sort list belongs to.
     */
    public function customer()
    {
        return $this->belongsTo(
                SortListCustomer::class,
                'sort_list_customer_uuid',
                'uuid'
            );
    }

    /**
     * Get the material that the sort list belongs to.
     */
    public function material()
    {
        return $this->belongsTo(
                Material::class,
                'material_uuid',
                'uuid'
            );
    }
}
