<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name_ar',
        'name_en',
        'building_style',
        'project_number',
        'cities',
        'neighborhood',
        'type',
        'status',
        'units_number',
        'payment_options',
        'delivery_time',
        'is_visible_employee',
        'address_map',
        'address_input',
        'attachment',
        'description',
        'features',
        'services',
        'after_sales',
        'optional_service',
        'project_instrument',
        'project_building_permit',
        'construction_completion_certificate',
        'electricity_connection_certificate',
        'is_deleted',
        'grantee_id',
    ];

    protected $casts = [
        'cities' => 'array',
        'features' => 'array',
        'services' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function grantee(): BelongsTo
    {
        return $this->belongsTo(Grantee::class);
    }

    /**
     * @return HasMany
     */
    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }
}
