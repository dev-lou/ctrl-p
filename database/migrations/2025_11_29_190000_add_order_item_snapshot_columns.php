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
        if (!Schema::hasColumn('order_items', 'product_name')) {
            Schema::table('order_items', function (Blueprint $table) {
                // Store product name snapshot; keep not-null with a sensible default
                $table->string('product_name')->default('Unknown Product')->after('product_variant_id');
            });
        }

        if (!Schema::hasColumn('order_items', 'variant_name')) {
            Schema::table('order_items', function (Blueprint $table) {
                // Variant name may be null
                $table->string('variant_name')->nullable()->after('product_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('order_items', 'variant_name')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropColumn('variant_name');
            });
        }

        if (Schema::hasColumn('order_items', 'product_name')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropColumn('product_name');
            });
        }
    }
};
