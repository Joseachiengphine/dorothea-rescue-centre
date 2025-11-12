<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'previously_attended',
        'previous_school_name',
        'previous_school_location',
        'previous_school_type',
        'previous_school_day_boarding',
        'currently_attending',
        'current_school_name',
        'current_school_location',
        'current_school_type',
        'current_school_day_boarding',
        'education_level',
        'current_education_level_detail',
    ];

    protected $casts = [
        'previously_attended' => 'boolean',
        'currently_attending' => 'boolean',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}

