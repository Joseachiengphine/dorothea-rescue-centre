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
        Schema::create('siblings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('last_known_location')->nullable();
            $table->string('occupation_or_education')->nullable();
            $table->integer('age')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('living_with_child')->default(false); // "Are there other siblings living with the child now"
            $table->boolean('admitted_elsewhere')->default(false); // "Are there other siblings admitted into care elsewhere"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siblings');
    }
};

