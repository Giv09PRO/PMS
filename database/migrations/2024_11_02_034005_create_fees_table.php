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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->string('fee_type'); // e.g., term fee, graduation fee
            $table->decimal('amount', 10, 2); // Amount for this specific fee type
            $table->decimal('discount', 10, 2)->default(0.00); // Discount applicable
            $table->decimal('final_amount', 10, 2); // Final amount after discount
            $table->decimal('total_fee', 10, 2); // Total fee including all terms and additional fees
            $table->enum('payment_status', ['pending', 'partial', 'paid'])->default('pending');
            $table->date('due_date'); // Due date for payment
            $table->date('payment_date')->nullable(); // Date of payment
            $table->string('payment_method')->nullable(); // Payment method used
            $table->string('transaction_id')->nullable(); // Transaction ID from bank/invoice
            $table->text('notes')->nullable(); // Additional notes
            $table->foreignId('created_by')->constrained('users'); // User who created the record
            $table->foreignId('updated_by')->nullable()->constrained('users'); // User who updated the record
            $table->timestamps(); // Timestamps for record keeping
            $table->softDeletes(); // Soft delete functionality
            
            // Additional fee columns
            $table->string('additional_fee_type')->nullable(); // Type of additional fee (e.g., graduation, study tour)
            $table->decimal('additional_fee_amount', 10, 2)->nullable(); // Amount for the additional fee
            $table->date('additional_fee_due_date')->nullable(); // Optional due date for additional fee payment
            $table->text('additional_fee_notes')->nullable(); // Any additional notes for additional fees
            
            $table->index(['student_id', 'fee_type', 'payment_status']);
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
