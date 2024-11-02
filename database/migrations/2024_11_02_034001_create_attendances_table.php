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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ensure it references the correct table
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Ensure it references the correct table
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->enum('status', ['pending', 'present', 'absent'])->default('pending'); // Changed to enum for clarity
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Adds the deleted_at column for soft deletes

            // Indexes for performance
            $table->index('user_id');
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Remove the deleted_at column
        });
        
        Schema::dropIfExists('attendances');
    }
};
