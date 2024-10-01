<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SkidAlloted extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_skid_alloted';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'material_request_srlnum';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'skid_id',
        'material_request_srlnum',
    ];

    public $timestamps = false;

    /**
     * Get the material request that is alloted.
     */
    public function request(): HasOne
    {
        return $this->hasOne(
            MaterialRequest::class,
            'srlnum',
            'material_request_srlnum'
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
