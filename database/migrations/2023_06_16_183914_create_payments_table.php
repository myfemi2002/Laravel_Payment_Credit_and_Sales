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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->date('purchase_date');
            $table->string('product_name')->nullable();
            $table->decimal('product_amount', 10, 2);
            $table->integer('product_quantity');
            $table->decimal('product_total_amount', 10,2);
            $table->decimal('amount_paid', 10,2);
            $table->decimal('total_amount_paid', 10,2);
            $table->enum('payment_status', ['paid', 'unpaid', 'partially'])->default('unpaid');
            $table->text('remark')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
