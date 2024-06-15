<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'unit_number',
        'floor',
        'model',
        'status',
        'price',
        'address_map',
        'address_input',
        'building_facade',
        'building_position',
        'area',
        'space_area',
        'total_area',
        'bedroom_main',
        'bedroom',
        'total_bedroom',
        'bathroom',
        'bathroom_inside',
        'bathroom_guest',
        'total_bathroom',
        'living',
        'divan',
        'open_divan',
        'dining_rooms',
        'kitchen',
        'kitchen_type',
        'laundry_rooms',
        'store_room',
        'servant_room',
        'park',
        'balcony',
        'terrace',
        'private_entrance',
        'havac',
        'images',
        'unit_deed',
        'construction_license',
        'sorting_report',
        'architectural_plan',
        'architectural_plan_pdf',
        'chart',
        'structural_plan',
        'is_for_rent',
        'features',
        'services',
        'after_sales',
        'operational_services',
        'is_deleted',
        'building_id',
        'grantee_id'
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'services' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * @return BelongsTo
     */
    public function grantee(): BelongsTo
    {
        return $this->belongsTo(Grantee::class);
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }


}
