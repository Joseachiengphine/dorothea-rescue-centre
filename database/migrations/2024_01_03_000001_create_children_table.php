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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->string('nickname')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth_county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('village')->nullable();
            $table->boolean('place_of_birth_known')->default(true);
            $table->string('ethnicity')->nullable();
            $table->enum('religion', ['Christian', 'Muslim', 'Hindu', 'Other'])->nullable();
            $table->string('complexion')->nullable();
            $table->text('physical_features')->nullable();
            $table->string('sub_location')->nullable(); // From "Home of Particulars"
            $table->text('landmark')->nullable(); // Landmark (e.g. school/church/mosque/market)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};

