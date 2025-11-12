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
        Schema::create('rescue_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->string('found_by')->nullable(); // "Name of institution/Person that found the child"
            $table->text('found_location')->nullable(); // "Where was the child found?"
            $table->date('date_found')->nullable(); // "When was the child found?"
            $table->text('case_history')->nullable(); // "Child Case History" section
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rescue_details');
    }
};

