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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained('subjects')->onDelete('cascade'); // Adjust table name as needed
            $table->decimal('term1', 5, 2)->nullable();
            $table->decimal('term2', 5, 2)->nullable();
            $table->decimal('term3', 5, 2)->nullable();
            $table->decimal('term4', 5, 2)->nullable();
            $table->decimal('monthly_test', 5, 2)->nullable();
            $table->decimal('weekly_test', 5, 2)->nullable();
            $table->decimal('yearly_average', 5, 2)->nullable();
            $table->string('grade')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();

            // Adding indexes for faster lookups
            $table->index('student_id');
            $table->index('course_id');

            // Optional: Unique constraint to prevent duplicate results for the same student and course
            $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
