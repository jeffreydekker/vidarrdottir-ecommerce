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
    $table->string('customer_name');
    $table->string('customer_email');
    $table->string('customer_phone')->nullable();
    $table->string('customer_city');
    $table->string('customer_zipcode');
    $table->string('customer_street');
    $table->string('customer_housenumber');
    $table->string('customer_housenumber_addition')->nullable();
    $table->string('customer_country');
    $table->string('customer_state')->nullable();
    $table->string('customer_company')->nullable();
    $table->string('customer_address');
    $table->string('payment_option'); // Payment method, e.g. PayPal, iDEAL, etc.
    $table->text('order_note')->nullable();
    $table->decimal('total_price', 10, 2);
    $table->enum('status', [
        'pending',
        'payment_received',
        'ready_for_shipping',
        'shipped',
        'delivered'
    ])->default('pending');
    $table->timestamps(); // Created at / updated at
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
