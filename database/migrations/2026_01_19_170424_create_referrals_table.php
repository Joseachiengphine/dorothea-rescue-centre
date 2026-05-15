<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            
            // Basic referral information
            $table->date('referral_date');
            $table->string('referral_number')->unique();
            
            // Child basic information
            $table->string('child_first_name');
            $table->string('child_middle_name')->nullable();
            $table->string('child_surname');
            $table->string('child_nickname')->nullable();
            $table->enum('child_gender', ['Female'])->default('Female');
            $table->date('child_date_of_birth')->nullable();
            $table->integer('child_estimated_age')->nullable();
            $table->string('child_ethnicity')->nullable();
            $table->string('child_religion')->nullable();
            $table->text('child_physical_features')->nullable();
            
            // Child location information
            $table->string('child_county')->nullable();
            $table->string('child_sub_county')->nullable();
            $table->string('child_village')->nullable();
            $table->string('child_sub_location')->nullable();
            $table->text('child_landmark')->nullable();
            
            // Referrer information
            $table->string('referrer_name');
            $table->string('referrer_title')->nullable();
            $table->string('referrer_organization')->nullable();
            $table->string('referrer_contact');
            $table->text('referrer_address')->nullable();
            $table->string('referrer_relationship_to_child')->nullable();
            
            // Referral details
            $table->text('reason_for_referral');
            $table->text('circumstances_leading_to_referral');
            $table->text('immediate_needs')->nullable();
            $table->text('background_information')->nullable();
            
            // Current situation
            $table->string('current_location')->nullable();
            $table->string('current_caregiver')->nullable();
            $table->text('current_living_conditions')->nullable();
            
            // Health and education
            $table->text('health_status')->nullable();
            $table->boolean('attending_school')->default(false);
            $table->string('school_name')->nullable();
            $table->string('education_level')->nullable();
            
            // Family information
            $table->text('family_information')->nullable();
            $table->boolean('family_tracing_attempted')->default(false);
            $table->text('family_tracing_details')->nullable();
            
            // Urgency and recommendations
            $table->enum('urgency_level', ['Low', 'Medium', 'High', 'Critical'])->default('Medium');
            $table->text('recommended_action')->nullable();
            $table->text('additional_notes')->nullable();
            
            // Status tracking
            $table->enum('status', ['Pending', 'Under Review', 'Approved', 'Rejected', 'Admitted'])->default('Pending');
            $table->text('status_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('reviewed_by')->nullable();
            
            // Link to child record (if admission proceeds)
            $table->foreignId('child_id')->nullable()->constrained()->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};