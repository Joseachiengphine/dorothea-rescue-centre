<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StreetVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_date',
        'visit_number',
        'street_base_name',
        'area_in_nairobi',
        'contact_person',
        'contact_tel',
        'purpose_of_visit',
        'girl_name',
        'girl_age',
        'duration_in_street',
        'reasons_for_being_in_street',
        'activities_while_in_streets',
        'drugs_girl_is_using',
        'parents_guardian_name',
        'rural_particulars',
        'urban_particulars',
        'encounter_number',
        'encounter_findings',
        'recommendations',
        'officer_name',
        'officer_signature_date',
        'status',
        'follow_up_notes',
        'next_visit_date',
        'referral_id',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'officer_signature_date' => 'date',
        'next_visit_date' => 'date',
    ];

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($streetVisit) {
            if (empty($streetVisit->visit_number)) {
                $streetVisit->visit_number = 'SV-' . date('Y') . '-' . str_pad(
                    static::whereYear('created_at', date('Y'))->count() + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
