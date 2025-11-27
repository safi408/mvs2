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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Customer name
            $table->string('title')->nullable();    // Designation or small title
            $table->text('message');                // Review text
            $table->tinyInteger('rating')->default(5); // 1–5 rating
            $table->string('image')->nullable();    // Customer avatar
            $table->string('product_image')->nullable(); // Product image (optional)
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);   // For carousel order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
