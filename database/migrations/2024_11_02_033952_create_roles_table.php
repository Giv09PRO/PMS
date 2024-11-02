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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Unique identifier for the role
            $table->string('name')->unique(); // Unique name for the role
            $table->string('slug')->unique(); // URL-friendly identifier for the role
            $table->text('description')->nullable(); // Description of the role's responsibilities
            $table->boolean('is_active')->default(true); // Status indicating if the role is active
            $table->boolean('is_default')->default(false); // Indicator if this is the default role
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // Soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles'); // Drop the roles table if it exists
    }
};
