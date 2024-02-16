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
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->id();
            // user_id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // address_id
            $table->foreignId('address_id')->constrained('tbl_addresses')->onDelete('cascade');
            // subtotal
            $table->integer('subtotal');
            // shipping cost
            $table->integer('shipping_cost');
            // total cost
            $table->integer('total_cost');
            // status
            $table->enum('status', ['pending', 'paid', 'on_shipping', 'shipped', 'expired', 'cancelled']);
            // payment method
            $table->enum('payment_method', ['bank_transfer', 'ewallet', 'cod','card']);
            // payment virtual account
            $table->string('payment_va_name')->nullable();
            $table->string('payment_va_number')->nullable();
            // payment ewallet
            $table->string('payment_ewallet')->nullable();
            // shipping service
            $table->string('shipping_service');
            // shipping resi
            $table->string('shipping_resi')->nullable();
            // transaction number
            $table->string('transaction_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_orders');
    }
};
