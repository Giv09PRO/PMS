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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address')->nullable(); // Consider making this nullable
            $table->string('city')->nullable(); // Consider making this nullable
            $table->string('state')->nullable(); // Consider making this nullable
            $table->string('zip_code')->nullable(); // Consider making this nullable
            $table->timestamps();

            // Indexing for better performance
            $table->index('email');
            $table->index('phone_number');
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
