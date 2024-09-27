<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkidLocationHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_skid_location_history';

    /**
     * The primary key associated with the table.
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
        'id',
        'location_uid',
        'location_srlnum',
        'skid_id',
        'emp',
        'time_stamp',
        'action',
    ];
}
