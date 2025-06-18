<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewIrmChemical extends Model
{
    use SoftDeletes;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'barcode_label_id';

    /**
     * The table associated with the model.
     */
    protected $table = 'view_irm_chemicals';

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
}
