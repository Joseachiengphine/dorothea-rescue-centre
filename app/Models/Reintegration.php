<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reintegration extends Model
{
    use HasFactory;

    protected $fillable = [
        'reintegration_number',
        'child_id',
        'home_tracing_id',
        'child_name',
        'admission_number',
        'child_sex',
        'child_age',
        'date_of_admission',
        'date_of_birth',
        'ob_number',
        'date_of_exit',
        'reasons_for_exit',
        'receiving_person_name',
        'relationship_to_child',
        'receiving_person_address',
        'receiving_person_telephone',
        'receiving_person_signature',
        'receiving_person_signature_date',
        'reintegration_agreement_text',
        'parent_guardian_name',
        'parent_guardian_signature',
        'parent_guardian_signature_date',
        'authorizing_person_name',
        'authorizing_person_designation',
        'authorizing_person_signature',
        'official_stamp_applied',
        'authorization_date',
        'comments_remarks',
        'status',
        'reintegration_type',
        'follow_up_plan',
        'first_follow_up_date',
        'success_indicators',
        'support_services_provided',
    ];

    protected $casts = [
        'date_of_admission' => 'date',
        'date_of_birth' => 'date',
        'date_of_exit' => 'date',
        'receiving_person_signature_date' => 'date',
        'parent_guardian_signature_date' => 'date',
        'authorization_date' => 'date',
        'first_follow_up_date' => 'date',
        'official_stamp_applied' => 'boolean',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function homeTracing(): BelongsTo
    {
        return $this->belongsTo(HomeTracing::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reintegration) {
            if (empty($reintegration->reintegration_number)) {
                $reintegration->reintegration_number = 'RI-' . date('Y') . '-' . str_pad(
                    static::whereYear('created_at', date('Y'))->count() + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
