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
        // Create the income_categories table
        Schema::create('income_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->unique(); // Unique name for the income category
            $table->text('description')->nullable(); // Optional description of the category
            $table->timestamps(); // Timestamps for record keeping
            $table->softDeletes(); // Soft delete functionality
        });

        // Create the income_sources table
        Schema::create('income_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('description')->nullable();
            $table->enum('type', ['fees', 'donations', 'grants', 'fundraising', 'other']);
            $table->enum('frequency', ['one-time', 'monthly', 'quarterly', 'annually', 'variable']);
            $table->boolean('is_active')->default(true);
            $table->decimal('expected_amount', 12, 2)->nullable();
            $table->string('reference_number')->nullable()->unique();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_sources');
        Schema::dropIfExists('income_categories');
    }
};
