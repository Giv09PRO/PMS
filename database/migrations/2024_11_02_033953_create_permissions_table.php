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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // Unique identifier for the permission
            $table->string('name')->unique(); // Unique name for the permission
            $table->string('slug')->unique(); // URL-friendly identifier for the permission
            $table->string('description')->nullable(); // Description of the permission's purpose
            $table->boolean('active')->default(true); // Status indicating if the permission is active
            $table->string('guard_name')->default('web'); // Guard name to define the authentication context
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // Soft delete support
            
            // Index for faster lookups on name and guard_name
            $table->index(['name', 'guard_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions'); // Drop the permissions table if it exists
    }
};
