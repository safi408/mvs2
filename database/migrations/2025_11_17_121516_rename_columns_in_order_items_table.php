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
        Schema::table('order_items', function (Blueprint $table) {
            //
            // Ensure these old columns exist in your DB
            $table->renameColumn('product_name', 'name');
            $table->renameColumn('product_image', 'image');
            $table->renameColumn('variant_color', 'color');
            $table->renameColumn('variant_sizes', 'size');
            $table->renameColumn('unit_price', 'price');
            $table->renameColumn('total_price', 'total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
            // Revert the names
            $table->renameColumn('name', 'product_name');
            $table->renameColumn('image', 'product_image');
            $table->renameColumn('color', 'variant_color');
            $table->renameColumn('size', 'variant_sizes');
            $table->renameColumn('price', 'unit_name');
            $table->renameColumn('total', 'total_price');
        });
    }
};
