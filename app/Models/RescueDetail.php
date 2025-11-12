<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RescueDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'found_by',
        'found_location',
        'date_found',
        'case_history',
    ];

    protected $casts = [
        'date_found' => 'date',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}

