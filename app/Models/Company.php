<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'company_name',
        'speciality',
        'technician',
        'is_deleted'
    ];

    /**
     * @return HasMany
     */
    public function grantees(): HasMany
    {
        return $this->hasMany(Grantee::class);
    }

    public function projects(): hasMany
    {
        return $this->hasMany(Project::class);
    }
}
