<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->date('date_of_admission')->nullable();
            $table->integer('age_at_admission')->nullable();
            $table->boolean('admission_order_issued')->default(false);
            $table->string('committal_order_no')->nullable();
            $table->date('date_of_committal')->nullable();
            $table->string('ob_number')->nullable();
            $table->string('referred_by_name')->nullable();
            $table->string('referred_by_title')->nullable();
            $table->string('relationship_to_child')->nullable();
            $table->string('contact')->nullable();
            $table->string('location')->nullable();
            $table->text('address_of_current_care_provider')->nullable(); // Address separate from name
            $table->string('other_forms_of_admission')->nullable(); // "Self-referral", "Abandoned at CCI"
            $table->string('current_care_type')->nullable(); // Could be JSON or separate junction table if multiple
            $table->text('current_care_address')->nullable();
            $table->string('registration_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};

