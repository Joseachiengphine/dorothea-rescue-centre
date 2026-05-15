<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_date',
        'referral_number',
        'child_first_name',
        'child_middle_name',
        'child_surname',
        'child_nickname',
        'child_gender',
        'child_date_of_birth',
        'child_estimated_age',
        'child_ethnicity',
        'child_religion',
        'child_physical_features',
        'child_county',
        'child_sub_county',
        'child_village',
        'child_sub_location',
        'child_landmark',
        'referrer_name',
        'referrer_title',
        'referrer_organization',
        'referrer_contact',
        'referrer_address',
        'referrer_relationship_to_child',
        'reason_for_referral',
        'circumstances_leading_to_referral',
        'immediate_needs',
        'background_information',
        'current_location',
        'current_caregiver',
        'current_living_conditions',
        'health_status',
        'attending_school',
        'school_name',
        'education_level',
        'family_information',
        'family_tracing_attempted',
        'family_tracing_details',
        'urgency_level',
        'recommended_action',
        'additional_notes',
        'status',
        'status_notes',
        'reviewed_at',
        'reviewed_by',
        'child_id',
    ];

    protected $casts = [
        'referral_date' => 'date',
        'child_date_of_birth' => 'date',
        'attending_school' => 'boolean',
        'family_tracing_attempted' => 'boolean',
        'reviewed_at' => 'datetime',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function streetVisits(): HasMany
    {
        return $this->hasMany(StreetVisit::class);
    }

    public function getChildFullNameAttribute(): string
    {
        $parts = array_filter([
            $this->child_first_name,
            $this->child_middle_name,
            $this->child_surname,
        ]);

        return implode(' ', $parts);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($referral) {
            if (empty($referral->referral_number)) {
                $referral->referral_number = 'REF-' . date('Y') . '-' . str_pad(
                    static::whereYear('created_at', date('Y'))->count() + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
