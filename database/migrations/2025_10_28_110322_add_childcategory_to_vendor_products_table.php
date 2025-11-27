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
        Schema::table('vendor_products', function (Blueprint $table) {
            //
                    if (!Schema::hasColumn('vendor_products', 'childcategory_id')) {
                $table->foreignId('childcategory_id')
                      ->nullable()
                      ->constrained('child_categories')
                      ->onDelete('cascade')
                      ->after('subcategory_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            //
                        if (Schema::hasColumn('vendor_products', 'childcategory_id')) {
                // drop foreign key first
                $table->dropForeign(['childcategory_id']);
                $table->dropColumn('childcategory_id');
            }
        });
    }
};
