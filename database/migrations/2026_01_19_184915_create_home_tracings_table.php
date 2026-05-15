<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_tracings', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('tracing_number')->unique();
            $table->date('tracing_date');
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            
            // Girl and location information
            $table->string('girl_name');
            $table->integer('girl_age');
            $table->string('home_place')->nullable();
            $table->text('landmark')->nullable();
            $table->string('nearest_town')->nullable();
            $table->string('nearest_school')->nullable();
            $table->string('nearest_church')->nullable();
            $table->string('nearest_chief_name')->nullable();
            $table->string('nearest_chief_office')->nullable();
            $table->string('chief_contact')->nullable();
            
            // Leave permission details
            $table->boolean('permission_granted')->default(false);
            $table->string('permission_purpose')->nullable();
            $table->date('leave_from_date')->nullable();
            $table->date('leave_to_date')->nullable();
            $table->integer('leave_duration_days')->nullable();
            $table->date('expected_return_date')->nullable();
            $table->time('expected_return_time')->default('16:00');
            
            // Parents/Guardian first meeting attitude
            $table->text('parents_first_meeting_attitude')->nullable();
            
            // Purpose of visit
            $table->text('purpose_of_visit')->nullable();
            
            // Family information (JSON for multiple family members)
            $table->json('parental_guardian_relatives')->nullable();
            
            // Reasons why child went to streets
            $table->text('reasons_child_went_to_streets')->nullable();
            
            // Siblings information (JSON for multiple siblings)
            $table->json('siblings_information')->nullable();
            
            // Home situation observation
            $table->text('home_situation_observation')->nullable();
            
            // Staff and signatures
            $table->string('staff_in_charge');
            $table->date('staff_signature_date');
            $table->string('girl_signature')->nullable();
            $table->string('parent_signature')->nullable();
            $table->string('social_worker_name')->nullable();
            $table->date('social_worker_signature_date')->nullable();
            $table->string('director_signature')->default('Sr. Caroline Ngatia');
            $table->date('director_signature_date')->nullable();
            
            // Status and follow-up
            $table->enum('status', ['Planned', 'In Progress', 'Completed', 'Cancelled'])->default('Planned');
            $table->enum('outcome', ['Successful Reintegration', 'Partial Success', 'Failed', 'Ongoing'])->nullable();
            $table->text('follow_up_notes')->nullable();
            $table->date('next_visit_date')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_tracings');
    }
};