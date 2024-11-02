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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('period_type', ['Regular', 'Break', 'Assembly', 'Extra-Curricular']);
            $table->string('room_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->string('academic_year');
            $table->enum('term', ['First', 'Second', 'Third', 'Fourth']);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['class_id', 'day_of_week', 'start_time']);
            $table->unique(['class_id', 'day_of_week', 'start_time', 'teacher_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
