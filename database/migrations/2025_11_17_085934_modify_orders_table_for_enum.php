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
        Schema::table('orders', function (Blueprint $table) {
            //
        $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid')->change();
        $table->enum('order_status', ['pending', 'delivered', 'cancelled', 'processing'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        $table->string('payment_status')->default('unpaid')->change();
        $table->string('order_status')->default('pending')->change();

        });
    }
};
