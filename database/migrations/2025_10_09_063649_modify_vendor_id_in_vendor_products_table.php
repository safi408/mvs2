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
                       // ✅ Drop old foreign key first
            $table->dropForeign(['vendor_id']);
            
            // ✅ Modify column (nullable)
            $table->unsignedBigInteger('vendor_id')->nullable()->change();

            // ✅ Re-add foreign key with new onDelete behavior
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            //

            $table->dropForeign(['vendor_id']);
            $table->unsignedBigInteger('vendor_id')->nullable(false)->change();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');

        });
    }
};
