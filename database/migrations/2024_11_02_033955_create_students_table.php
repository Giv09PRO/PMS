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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number_1')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->string('student_id')->unique();
            $table->unsignedBigInteger('class_id')->nullable(); // ensure 'classes' table is created first
            $table->foreignId('section_id')->nullable()->constrained()->onDelete('set null'); // ensure 'sections' table is created first
            $table->decimal('current_average', 5, 2)->nullable();
            $table->integer('total_attendance')->default(0);
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('relationship_to_student')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->text('special_needs')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['first_name', 'last_name']);
            $table->index('email');
            $table->index('student_id');

            // Adding foreign key reference for class_id
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null'); // ensure 'classes' is migrated before this
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
