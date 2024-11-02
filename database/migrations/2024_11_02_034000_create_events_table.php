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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location', 255)->nullable();
            $table->enum('type', ['academic', 'sports', 'cultural', 'holiday', 'other']);
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
            $table->boolean('is_public')->default(true);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->text('notes')->nullable();
            $table->integer('max_participants')->nullable();
            $table->boolean('requires_registration')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

            $table->index(['start_date', 'end_date']);
            $table->index('type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
