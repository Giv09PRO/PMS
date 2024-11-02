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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('qualification');
            $table->string('subject_specialization');
            $table->string('employee_id')->unique();
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['first_name', 'last_name']);
            $table->index('email');
            $table->index('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
