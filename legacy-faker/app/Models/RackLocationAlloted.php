<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
