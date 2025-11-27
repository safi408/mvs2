<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            // Check if old column exists
            if (Schema::hasColumn('product_variants', 'color_name') && !Schema::hasColumn('product_variants', 'color')) {
                $table->renameColumn('color_name', 'color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            if (Schema::hasColumn('product_variants', 'color') && !Schema::hasColumn('product_variants', 'color_name')) {
                $table->renameColumn('color', 'color_name');
            }
        });
    }
};
