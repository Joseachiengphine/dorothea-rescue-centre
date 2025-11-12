<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreviousPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'placement_type',
        'from',
        'to',
        'notes',
    ];

    protected $casts = [
        'from' => 'date',
        'to' => 'date',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}

