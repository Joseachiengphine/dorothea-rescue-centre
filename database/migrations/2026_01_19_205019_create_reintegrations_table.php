<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reintegrations', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('reintegration_number')->unique();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->foreignId('home_tracing_id')->nullable()->constrained()->onDelete('set null');
            
            // Child details (from form)
            $table->string('child_name');
            $table->string('admission_number')->nullable();
            $table->enum('child_sex', ['Female'])->default('Female');
            $table->integer('child_age');
            $table->date('date_of_admission');
            $table->date('date_of_birth')->nullable();
            $table->string('ob_number')->nullable();
            $table->date('date_of_exit');
            $table->text('reasons_for_exit');
            
            // Exit destination
            $table->string('receiving_person_name');
            $table->string('relationship_to_child');
            $table->text('receiving_person_address');
            $table->string('receiving_person_telephone')->nullable();
            $table->string('receiving_person_signature')->nullable();
            $table->date('receiving_person_signature_date')->nullable();
            
            // Reintegration agreement
            $table->text('reintegration_agreement_text')->nullable();
            $table->string('parent_guardian_name');
            $table->string('parent_guardian_signature')->nullable();
            $table->date('parent_guardian_signature_date')->nullable();
            
            // Person authorizing exit
            $table->string('authorizing_person_name');
            $table->string('authorizing_person_designation');
            $table->string('authorizing_person_signature')->nullable();
            $table->boolean('official_stamp_applied')->default(false);
            $table->date('authorization_date');
            $table->text('comments_remarks')->nullable();
            
            // Status and follow-up
            $table->enum('status', ['Planned', 'In Progress', 'Completed', 'Cancelled'])->default('Planned');
            $table->enum('reintegration_type', ['Family Reunion', 'Kinship Care', 'Foster Care', 'Independent Living', 'Other'])->default('Family Reunion');
            $table->text('follow_up_plan')->nullable();
            $table->date('first_follow_up_date')->nullable();
            $table->text('success_indicators')->nullable();
            $table->text('support_services_provided')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reintegrations');
    }
};