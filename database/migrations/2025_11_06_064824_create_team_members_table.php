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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_1');
            $table->string('destination_1');
            $table->string('facebook_1');
            $table->string('image_1');
            $table->string('name_2');
            $table->string('destination_2');
            $table->string('facebook_2');
            $table->string('image_2');
            $table->string('name_3');
            $table->string('destination_3');
            $table->string('facebook_3');
            $table->string('image_3');
            $table->string('name_4');
            $table->string('destination_4');
            $table->string('facebook_4');
            $table->string('image_4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
