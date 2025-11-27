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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            // 🧠 Multiple Title & Content fields
            $table->string('title_1')->nullable();
            $table->longText('content_1')->nullable();

            $table->string('title_2')->nullable();
            $table->longText('content_2')->nullable();

            $table->string('title_3')->nullable();
            $table->longText('content_3')->nullable();

            $table->string('title_4')->nullable();
            $table->longText('content_4')->nullable();

            $table->string('title_5')->nullable();
            $table->longText('content_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
