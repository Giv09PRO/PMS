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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_name');
            $table->string('exam_type');
            $table->unsignedBigInteger('exam_subject'); // Assuming this is a foreign key
            $table->unsignedBigInteger('exam_class'); // Assuming this is a foreign key
            $table->date('exam_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('total_marks');
            $table->integer('passing_marks');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Foreign key constraints (update if your tables are named differently)
            $table->foreign('exam_subject')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('exam_class')->references('id')->on('classes')->onDelete('cascade');

            // Optional: Unique constraint to prevent duplicate exams for the same class on the same date
            $table->unique(['exam_name', 'exam_date', 'exam_class']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
