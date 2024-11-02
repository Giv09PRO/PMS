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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 191)->primary();
            $table->string('token', 255);
            $table->string('user_type')->default('student'); // Assuming user_type can be 'student' or 'teacher', etc.
            $table->boolean('is_active')->default(true);
            $table->integer('attempt_count')->default(0);
            $table->timestamp('expires_at');
            $table->timestamps(); // This adds created_at and updated_at automatically
            $table->index(['email', 'token']); // Index for quick look-up
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
