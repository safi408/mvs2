<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shop_collections', function (Blueprint $table) {
            // 🧩 Update existing columns (if needed)
            $table->string('title', 255)->nullable()->change();
            $table->string('subtitle', 255)->nullable()->change();
            $table->string('button_text', 100)->nullable()->default('Shop Now')->change();
            $table->string('image', 255)->nullable()->change();

            // 🆕 Add first group (1)
            if (!Schema::hasColumn('shop_collections', 'title1')) {
                $table->string('title1')->nullable()->after('id');
            }

            if (!Schema::hasColumn('shop_collections', 'subtitle1')) {
                $table->string('subtitle1')->nullable()->after('title1');
            }

            if (!Schema::hasColumn('shop_collections', 'button_text1')) {
                $table->string('button_text1')->nullable()->default('Shop Now')->after('subtitle1');
            }

            if (!Schema::hasColumn('shop_collections', 'image1')) {
                $table->string('image1')->nullable()->after('button_text1');
            }

            // 🆕 Add second group (2)
            if (!Schema::hasColumn('shop_collections', 'title2')) {
                $table->string('title2')->nullable()->after('image1');
            }

            if (!Schema::hasColumn('shop_collections', 'subtitle2')) {
                $table->string('subtitle2')->nullable()->after('title2');
            }

            if (!Schema::hasColumn('shop_collections', 'button_text2')) {
                $table->string('button_text2')->nullable()->default('Shop Now')->after('subtitle2');
            }

            if (!Schema::hasColumn('shop_collections', 'image2')) {
                $table->string('image2')->nullable()->after('button_text2');
            }

            // ✅ Optional: Keep button_link + status
            if (!Schema::hasColumn('shop_collections', 'button_link')) {
                $table->string('button_link')->nullable()->after('button_text2');
            }

            if (!Schema::hasColumn('shop_collections', 'status')) {
                $table->boolean('status')->default(true)->after('button_link');
            }
        });
    }

    public function down(): void
    {
        Schema::table('shop_collections', function (Blueprint $table) {
            $columns = [
                'title1', 'subtitle1', 'button_text1', 'image1',
                'title2', 'subtitle2', 'button_text2', 'image2',
                'button_link', 'status'
            ];

            foreach ($columns as $col) {
                if (Schema::hasColumn('shop_collections', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
