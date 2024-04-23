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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('grand_total', 10, 2);
            $table->enum('status', ['new', 'processing', 'shipped', 'deliverd', 'canceled'])->default('new');
            $table->enum('payment_method', ['cash_on_delivery', 'paypal', 'stripe', 'razorpay', 'paystack', 'flutterwave', 'voguepay'])->default('stripe');
            $table->enum('payment_status', [ 'paid', 'unpaid'])->default('unpaid');
            $table->string('currency')->default('USD')->nullable();
            $table->string('shipping_amount')->default('0.00')->nullable();
            $table->string('shipping_method')->default('flat_rate')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
