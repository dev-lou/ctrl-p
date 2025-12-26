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
        Schema::table('service_options', function (Blueprint $table) {
            $table->string('price_bw_label', 100)->nullable()->after('price_bw');
            $table->string('price_color_label', 100)->nullable()->after('price_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_options', function (Blueprint $table) {
            $table->dropColumn(['price_bw_label', 'price_color_label']);
        });
    }
};
