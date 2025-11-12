<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'nickname',
        'gender',
        'date_of_birth',
        'place_of_birth_county',
        'sub_county',
        'village',
        'place_of_birth_known',
        'ethnicity',
        'religion',
        'complexion',
        'physical_features',
        'sub_location',
        'landmark',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'place_of_birth_known' => 'boolean',
    ];

    public function admission(): HasOne
    {
        return $this->hasOne(Admission::class);
    }

    public function parents(): HasMany
    {
        return $this->hasMany(ChildParent::class);
    }

    public function siblings(): HasMany
    {
        return $this->hasMany(Sibling::class);
    }

    public function rescueDetail(): HasOne
    {
        return $this->hasOne(RescueDetail::class);
    }

    public function educationBackground(): HasOne
    {
        return $this->hasOne(EducationBackground::class);
    }

    public function healthRecord(): HasOne
    {
        return $this->hasOne(HealthRecord::class);
    }

    public function previousPlacements(): HasMany
    {
        return $this->hasMany(PreviousPlacement::class);
    }

    public function signatures(): HasMany
    {
        return $this->hasMany(Signature::class);
    }

    public function getFullNameAttribute(): string
    {
        $parts = array_filter([
            $this->first_name,
            $this->middle_name,
            $this->surname,
        ]);

        return implode(' ', $parts);
    }
}

