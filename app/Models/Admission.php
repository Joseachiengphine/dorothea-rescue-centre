<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'date_of_admission',
        'age_at_admission',
        'admission_order_issued',
        'committal_order_no',
        'date_of_committal',
        'ob_number',
        'referred_by_name',
        'referred_by_title',
        'relationship_to_child',
        'contact',
        'location',
        'address_of_current_care_provider',
        'other_forms_of_admission',
        'current_care_type',
        'current_care_address',
        'registration_status',
    ];

    protected $casts = [
        'date_of_admission' => 'date',
        'date_of_committal' => 'date',
        'admission_order_issued' => 'boolean',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function admissionReasons(): HasMany
    {
        return $this->hasMany(AdmissionReason::class);
    }
}

