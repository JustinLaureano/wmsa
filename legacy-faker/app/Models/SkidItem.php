<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
     * Get the rack location alloted for the skid item.
     */
    public function alloted(): HasOne
    {
        return $this->hasOne(
            RackLocationAlloted::class,
            'skid_id',
            'skid_id'
        );
    }

    /**
     * Get the rack location associated with the skid item.
     */
    public function location(): HasOneThrough
    {
        return $this->hasOneThrough(
            RackLocation::class,
            SkidLocation::class,
            'skid_id', // tblwms_skid_location.skid_id
            'id', // tblwms_rack_location.id
            'skid_id', // tblwms_skid_item.skid_id
            'location_srlnum', // tblwms_skid_location.location_srlnum
        );
    }

    /**
     * Get the material request associated with the skid item.
     */
    public function request(): HasOneThrough
    {
        return $this->hasOneThrough(
            MaterialRequest::class,
            SkidAlloted::class,
            'skid_id', // tblwms_skid_alloted.skid_id
            'srlnum', // tblmaterialrequest.srlnum
            'skid_id', // tblwms_skid_item.skid_id
            'material_request_srlnum', // tblwms_skid_alloted.material_request_srlnum
        );
    }

    /**
     * Get the building one area associated with the skid item.
     */
    public function buildingOneArea(): HasOneThrough
    {
        return $this->hasOneThrough(
            ItemLocationBuildingOne::class,
            ItemLocation::class,
            'item', // tblwms_item_locations.item
            'id', // tblwms_item_locations_building_one.id
            'item', // tblwms_skid_item.item
            'building_1_area', // tblwms_item_locations.building_1_area
        );
    }

    /**
     * Get the building two area associated with the skid item.
     */
    public function buildingTwoArea(): HasOneThrough
    {
        return $this->hasOneThrough(
            ItemLocationBuildingTwo::class,
            ItemLocation::class,
            'item', // tblwms_item_locations.item
            'id', // tblwms_item_locations_building_one.id
            'item', // tblwms_skid_item.item
            'building_2_area', // tblwms_item_locations.building_2_area
        );
    }

    /**
     * Get the building three area associated with the skid item.
     */
    public function buildingThreeArea(): HasOneThrough
    {
        return $this->hasOneThrough(
            ItemLocationBuildingThree::class,
            ItemLocation::class,
            'item', // tblwms_item_locations.item
            'id', // tblwms_item_locations_building_one.id
            'item', // tblwms_skid_item.item
            'building_3_area', // tblwms_item_locations.building_3_area
        );
    }

    /**
     * Get the location history for the skid item.
     */
    public function history(): HasMany
    {
        return $this->hasMany(SkidLocationHistory::class, 'skid_id', 'skid_id');
    }
}
