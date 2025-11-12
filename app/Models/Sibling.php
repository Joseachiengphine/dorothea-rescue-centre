<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sibling extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'name',
        'last_known_location',
        'occupation_or_education',
        'age',
        'contact',
        'living_with_child',
        'admitted_elsewhere',
    ];

    protected $casts = [
        'living_with_child' => 'boolean',
        'admitted_elsewhere' => 'boolean',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}

