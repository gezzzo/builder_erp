<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'salesman',
        'interest',
        'payment_method',
        'contact_method',
        'budget',
        'city',
        'neighbourhood',
        'notes',
        'national_id',
        'national_address',
        'iban_certification',
        'legal_agent',
        'is_lead',
        'is_tax_exempted',
        'is_deleted',
        'is_active',
    ];

    protected $casts = [
        'interest' => 'array',
    ];

    /**
     * @return HasMany
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
