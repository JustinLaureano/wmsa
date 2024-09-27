<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RackLocationAlloted extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_rack_location_alloted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_srlnum',
        'skid_id'
    ];

    public $timestamps = false;

    /**
     * Get the rack location that is alloted.
     */
    public function location(): HasOne
    {
        return $this->hasOne(
            RackLocation::class,
            'id',
            'location_srlnum'
        );
    }

    /**
     * Get the skid item that is alloted.
     */
    public function item(): HasOne
    {
        return $this->hasOne(
            SkidItem::class,
            'skid_id',
            'skid_id'
        );
    }
}
