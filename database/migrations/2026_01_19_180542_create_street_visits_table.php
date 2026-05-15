<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('street_visits', function (Blueprint $table) {
            $table->id();
            
            // Visit information
            $table->date('visit_date');
            $table->string('visit_number')->unique();
            
            // Street/base information
            $table->string('street_base_name');
            $table->string('area_in_nairobi');
            $table->string('contact_person')->nullable();
            $table->string('contact_tel')->nullable();
            $table->text('purpose_of_visit')->nullable();
            
            // Girl identification details
            $table->string('girl_name');
            $table->integer('girl_age')->nullable();
            $table->text('duration_in_street');
            $table->text('reasons_for_being_in_street');
            $table->text('activities_while_in_streets')->nullable();
            $table->text('drugs_girl_is_using')->nullable();
            $table->string('parents_guardian_name')->nullable();
            $table->text('rural_particulars')->nullable();
            $table->text('urban_particulars')->nullable();
            
            // Encounter tracking
            $table->enum('encounter_number', ['1st', '2nd', '3rd'])->default('1st');
            $table->text('encounter_findings')->nullable();
            $table->text('recommendations')->nullable();
            
            // Officer information
            $table->string('officer_name');
            $table->date('officer_signature_date');
            
            // Status and follow-up
            $table->enum('status', ['Active', 'Referred', 'Lost Contact', 'Completed'])->default('Active');
            $table->text('follow_up_notes')->nullable();
            $table->date('next_visit_date')->nullable();
            
            // Link to referral (if girl is eventually referred)
            $table->foreignId('referral_id')->nullable()->constrained()->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('street_visits');
    }
};