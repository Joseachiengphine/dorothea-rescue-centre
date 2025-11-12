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
        Schema::create('previous_placements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->string('placement_type'); // "CCI", "Kinship", "Foster", "Kafaalah", "Guardianship", "Temporary", "Other"
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->text('notes')->nullable(); // For additional details like "various CCIs" mentioned in form
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previous_placements');
    }
};

