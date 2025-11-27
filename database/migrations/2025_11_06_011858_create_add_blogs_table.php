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
        Schema::create('add_blogs', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->string('author')->default('Themesflat');
            $table->date('publish_date')->nullable();
            $table->text('description')->nullable();
            $table->json('bullets')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->json('tags')->nullable();
            $table->string('related_previous_title')->nullable();
            $table->string('related_previous_url')->nullable();
            $table->string('related_next_title')->nullable();
            $table->string('related_next_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_blogs');
    }
};
