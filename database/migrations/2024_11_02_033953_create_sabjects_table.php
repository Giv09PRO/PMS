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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('code', 20)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('credits'); // used unsigned() method for clarity
            $table->boolean('is_active')->default(true);
            $table->string('department', 100)->index();
            $table->unsignedInteger('semester'); // used unsigned() method for clarity
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'code']);
            $table->index('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
