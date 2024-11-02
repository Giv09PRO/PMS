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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 191)->unique()->index();
            $table->string('connection', 255);
            $table->string('queue', 255);
            $table->longText('payload');
            $table->longText('exception');
            $table->text('error_message')->nullable();
            $table->integer('attempts')->default(0);
            $table->timestamp('failed_at')->useCurrent();
            $table->timestamp('last_retry_at')->nullable();
            $table->string('failed_by')->nullable();
            $table->foreignId('school_id')->nullable()->constrained()->onDelete('set null'); // Reference to schools table
            $table->boolean('is_critical')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
