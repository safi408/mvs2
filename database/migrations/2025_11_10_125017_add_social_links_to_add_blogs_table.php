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
        Schema::table('add_blogs', function (Blueprint $table) {
            //
        $table->string('facebook')->nullable();
        $table->string('x')->nullable();
        $table->string('instagram')->nullable();
        $table->string('tiktok')->nullable();
        $table->string('youtube')->nullable();
        $table->string('pinterest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_blogs', function (Blueprint $table) {
            //
            $table->dropColumn(['facebook','x','instagram','tiktok','youtube','pinterest']);
        });
    }
};
