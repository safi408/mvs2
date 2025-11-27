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
        Schema::create('faq_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // "FAQS Grid"
            $table->string('breadcrumb')->nullable(); // "Homepage / FAQS / FAQS Grid"
            $table->string('image')->nullable(); // banner image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_banners');
    }
};
