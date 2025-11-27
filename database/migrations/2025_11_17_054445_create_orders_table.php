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

    // USER
    $table->unsignedBigInteger('user_id')->nullable();

    // ORDER DETAILS
    $table->string('order_number')->unique();
    $table->string('payment_method');         // cod / card / stripe
    $table->string('payment_status')->default('unpaid'); // unpaid / paid
    $table->string('order_status')->default('pending');  // pending, delivered, cancelled

    // STRIPE INFO
    $table->string('stripe_payment_id')->nullable();  // Stripe PaymentIntent ID
    $table->string('stripe_client_secret')->nullable(); // for frontend payment confirmation
    $table->json('stripe_payment_response')->nullable(); // store Stripe payment response (optional)

    // CUSTOMER INFO
    $table->string('first_name');
    $table->string('last_name');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->string('country');
    $table->string('city');
    $table->string('state')->nullable();
    $table->string('street')->nullable();
    $table->string('postal_code')->nullable();

    // NOTES
    $table->text('note')->nullable();

    // PRICE SUMMARY
    $table->decimal('subtotal', 10, 2)->default(0);
    $table->decimal('discount', 10, 2)->default(0);
    $table->decimal('shipping', 10, 2)->default(0);
    $table->decimal('total', 10, 2)->default(0);

    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
