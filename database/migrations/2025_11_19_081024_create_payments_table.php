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
            // 🔹 Relation with Order
            $table->unsignedBigInteger('order_id');

            // 🔹 Payment Method (ENUM)
            $table->enum('payment_method', ['cod', 'stripe', 'paypal'])->default('cod');

            // 🔹 Payment Status (ENUM)
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');

            // 🔹 Transaction Info
            $table->string('transaction_id')->nullable();     // Gateway transaction id
            $table->json('payment_response')->nullable();    // Raw JSON response from gateway

            // 🔹 Amount
            $table->decimal('amount', 10, 2);

            // 🔹 PCI-safe Card Info
            $table->string('card_number')->nullable(); // Last 4 digits only
            $table->string('card_name')->nullable();        // Visa, MasterCard
            $table->date('card_date')->nullable();           // Expiry date (YYYY-MM-DD)

            $table->timestamps();

            // 🔹 Foreign key
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
