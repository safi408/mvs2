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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
                                   // Link to users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Vendor fields
            $table->string('store_name')->nullable();
            $table->string('store_slug')->unique()->nullable();
            $table->string('store_logo')->nullable();
            $table->text('store_description')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // Status
            $table->enum('status', ['pending', 'active', 'blocked'])->default('pending');
            $table->boolean('is_verified')->default(false);

            // Commission (optional)
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
