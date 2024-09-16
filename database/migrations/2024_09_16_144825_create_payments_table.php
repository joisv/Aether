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
            $table->unsignedBigInteger('order_id');
            $table->enum('payment_method', ['transfer_bank', 'credit_cart', 'paypal']);
            $table->enum('payment_status', ['pending', 'complete', 'failed'])->default('pending');
            $table->decimal('paid_amount', 10, 2);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
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
