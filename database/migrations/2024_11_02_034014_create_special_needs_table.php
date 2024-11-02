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
        Schema::create('special_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('condition_name', 100);
            $table->text('description')->nullable();
            $table->string('severity_level', 20);
            $table->text('accommodation_requirements')->nullable();
            $table->string('medical_documentation', 255)->nullable();
            $table->date('diagnosis_date')->nullable();
            $table->string('specialist_name', 100)->nullable();
            $table->string('specialist_contact', 50)->nullable();
            $table->text('emergency_procedures')->nullable();
            $table->json('additional_support_details')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['student_id', 'condition_name']);
            $table->index('severity_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_needs');
    }
};
