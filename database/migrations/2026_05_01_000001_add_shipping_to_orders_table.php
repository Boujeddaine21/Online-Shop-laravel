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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_street')->nullable()->after('payment_status');
            $table->string('shipping_city')->nullable()->after('shipping_street');
            $table->string('shipping_zip')->nullable()->after('shipping_city');
            $table->string('shipping_country')->default('Deutschland')->after('shipping_zip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_street', 'shipping_city', 'shipping_zip', 'shipping_country']);
        });
    }
};
