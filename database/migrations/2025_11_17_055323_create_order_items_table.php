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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Relation to orders
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Relation to products
            $table->unsignedBigInteger('vendor_product_id');
            $table->foreign('vendor_product_id')->references('id')->on('vendor_products')->onDelete('cascade');

            // Optional: Variant (if any)
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('set null');

            // Product details (snapshot)
            $table->string('product_image');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('variant_color')->nullable();
            $table->json('variant_sizes')->nullable(); // store selected sizes if any

            // Pricing
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2); // unit_price * quantity

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
