<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class SkidItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_skid_item';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uid';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'skid_id',
        'item',
        'lot',
        'qty',
        'specific_tote_id',
        'expire',
        'emp_num',
        'time',
        'partial',
        'lot_timestamp',
        'run',
        'locked',
        'departmental_part_type_id',
        'barcode',
    ];

    /**
     * Get the rack location associated with the skid item.
     */
    public function location(): HasOneThrough
    {
        return $this->hasOneThrough(
            RackLocation::class,
            SkidLocation::class,
            'skid_id',
            'id',
            'skid_id',
            'location_srlnum',
        );
    }
}
