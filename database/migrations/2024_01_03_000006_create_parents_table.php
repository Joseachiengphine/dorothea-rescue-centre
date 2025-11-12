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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->enum('type', ['Mother', 'Father']);
            $table->string('name')->nullable();
            $table->string('other_names')->nullable();
            $table->string('last_known_location')->nullable();
            $table->string('contact')->nullable();
            $table->string('occupation_or_education')->nullable(); // "Occupation/Education/Employment"
            $table->enum('status', ['Alive', 'Deceased', 'Not known'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};

