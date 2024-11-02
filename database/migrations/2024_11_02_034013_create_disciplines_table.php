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
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->string('incident_type');
            $table->text('description');
            $table->date('incident_date');
            $table->time('incident_time');
            $table->string('location');
            $table->enum('severity', ['minor', 'moderate', 'major']);
            $table->text('action_taken');
            $table->boolean('parent_notified')->default(false);
            $table->datetime('parent_notification_date')->nullable();
            $table->string('parent_response')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['student_id', 'incident_date']);
            $table->index('severity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplines');
    }
};
