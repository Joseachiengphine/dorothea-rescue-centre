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
        Schema::create('education_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->boolean('previously_attended')->default(false);
            $table->string('previous_school_name')->nullable();
            $table->string('previous_school_location')->nullable();
            $table->enum('previous_school_type', ['Public', 'Private'])->nullable();
            $table->enum('previous_school_day_boarding', ['Day', 'Boarding'])->nullable();
            $table->boolean('currently_attending')->default(false);
            $table->string('current_school_name')->nullable();
            $table->string('current_school_location')->nullable();
            $table->enum('current_school_type', ['Public', 'Private'])->nullable();
            $table->enum('current_school_day_boarding', ['Day', 'Boarding'])->nullable();
            $table->string('education_level')->nullable(); // General level
            $table->string('current_education_level_detail')->nullable(); // "ECD/Grade/Form/Vocational/Tertiary"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_backgrounds');
    }
};

