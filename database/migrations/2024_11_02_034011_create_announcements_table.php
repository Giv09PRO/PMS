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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('content');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('target_audience', ['students', 'teachers', 'parents', 'staff', 'all'])->default('all');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->dateTime('publish_at');
            $table->dateTime('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('attachment_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('publish_at');
            $table->index('priority');
            $table->index('target_audience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
