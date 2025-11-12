<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildParent extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'child_id',
        'type',
        'name',
        'other_names',
        'last_known_location',
        'contact',
        'occupation_or_education',
        'status',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}

