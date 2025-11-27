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
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('tab1_title')->default('Introduction');
            $table->text('tab1_content')->nullable();
            $table->string('tab2_title')->default('Our Vision');
            $table->text('tab2_content')->nullable();
            $table->string('tab3_title')->default('What Sets Us Apart');
            $table->text('tab3_content')->nullable();
            $table->string('tab4_title')->default('Our Commitment');
            $table->text('tab4_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
