<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profession_items', function (Blueprint $table) {
            $table->unsignedBigInteger('expiry_months')->after('item_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profession_items', function (Blueprint $table) {
            $table->dropColumn('expiry_months');
        });
    }
};
