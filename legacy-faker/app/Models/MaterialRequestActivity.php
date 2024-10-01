<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialRequestActivity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblmaterialrequest_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_srlnum',
        'emp',
        'device',
        'request_sts',
        'notes'
    ];

    public $timestamps = false;
}
