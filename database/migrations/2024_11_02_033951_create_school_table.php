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
        Schema::create('schools', function (Blueprint $table) {
            $table->id(); // Unique identifier for the school
            $table->string('name'); // School name
            $table->string('address'); // School address
            $table->string('phone')->nullable(); // Contact phone number
            $table->string('email')->nullable(); // School email address
            $table->string('principal')->nullable(); // Principal's name
            $table->string('status')->default('active'); // Status of the school (active/inactive)
            $table->string('website')->nullable(); // School website URL
            $table->text('description')->nullable(); // Description of the school
            $table->string('logo')->nullable(); // Path to the school's logo
            $table->boolean('is_active')->default(true); // Indicator if the school is currently active
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // Soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools'); // Drop the schools table if it exists
    }
};
