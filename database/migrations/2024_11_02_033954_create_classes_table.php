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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 100)->unique();
            $table->string('class_code', 20)->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('teacher_id'); // ensure the teachers table is created first
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('max_students')->default(30);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('teacher_id')
                  ->references('id')
                  ->on('users') // Make sure 'users' is migrated before 'classes'
                  ->onDelete('restrict');

            $table->index(['class_code', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes'); // Dropping only the 'classes' table
    }
};
