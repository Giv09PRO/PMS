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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('file_path', 1024);
            $table->string('file_type', 50);
            $table->unsignedBigInteger('size')->comment('File size in bytes');
            $table->string('description', 1000)->nullable();
            $table->enum('category', ['homework', 'syllabus', 'worksheet', 'report', 'other']);
            $table->enum('access_level', ['public', 'staff', 'student', 'parent', 'admin']);
            $table->unsignedBigInteger('uploaded_by');
            $table->unsignedBigInteger('grade_level')->nullable();
            $table->string('subject', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('restrict');
            $table->index(['category', 'access_level']);
            $table->index('grade_level');
            $table->index('subject');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
