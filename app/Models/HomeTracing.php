<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeTracing extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracing_number',
        'tracing_date',
        'child_id',
        'girl_name',
        'girl_age',
        'home_place',
        'landmark',
        'nearest_town',
        'nearest_school',
        'nearest_church',
        'nearest_chief_name',
        'nearest_chief_office',
        'chief_contact',
        'permission_granted',
        'permission_purpose',
        'leave_from_date',
        'leave_to_date',
        'leave_duration_days',
        'expected_return_date',
        'expected_return_time',
        'parents_first_meeting_attitude',
        'purpose_of_visit',
        'parental_guardian_relatives',
        'reasons_child_went_to_streets',
        'siblings_information',
        'home_situation_observation',
        'staff_in_charge',
        'staff_signature_date',
        'girl_signature',
        'parent_signature',
        'social_worker_name',
        'social_worker_signature_date',
        'director_signature',
        'director_signature_date',
        'status',
        'outcome',
        'follow_up_notes',
        'next_visit_date',
    ];

    protected $casts = [
        'tracing_date' => 'date',
        'leave_from_date' => 'date',
        'leave_to_date' => 'date',
        'expected_return_date' => 'date',
        'expected_return_time' => 'datetime:H:i',
        'staff_signature_date' => 'date',
        'social_worker_signature_date' => 'date',
        'director_signature_date' => 'date',
        'next_visit_date' => 'date',
        'permission_granted' => 'boolean',
        'parental_guardian_relatives' => 'array',
        'siblings_information' => 'array',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function reintegrations(): HasMany
    {
        return $this->hasMany(Reintegration::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($homeTracing) {
            if (empty($homeTracing->tracing_number)) {
                $homeTracing->tracing_number = 'HT-' . date('Y') . '-' . str_pad(
                    static::whereYear('created_at', date('Y'))->count() + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
