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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Unique identifier for the user
            $table->string('name'); // User's full name
            $table->string('email')->unique(); // Unique email address
            $table->string('username')->unique(); // Unique username
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // Hashed password
            $table->string('phone')->nullable(); // Contact phone number
            $table->text('address')->nullable(); // User's address
            $table->boolean('is_active')->default(true); // Status indicating if the user is active
            $table->boolean('is_admin')->default(false); // Indicator if the user has admin rights
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // Soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop the users table if it exists
    }
};
