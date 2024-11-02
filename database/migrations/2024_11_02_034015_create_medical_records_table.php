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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('blood_type', 5)->nullable();
            $table->text('allergies')->nullable();
            $table->text('chronic_conditions')->nullable();
            $table->text('medications')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_relationship');
            $table->string('primary_physician')->nullable();
            $table->string('physician_phone')->nullable();
            $table->text('immunization_records')->nullable();
            $table->date('last_physical_exam')->nullable();
            $table->boolean('has_insurance')->default(false);
            $table->string('insurance_provider')->nullable();
            $table->string('insurance_policy_number')->nullable();
            $table->text('special_instructions')->nullable();
            $table->text('medical_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('student_id');
            $table->index('blood_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
