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
        Schema::table('item_brands', function (Blueprint $table) {
            $table->text("model")->after("name")->nullable();
            $table->text("article")->after("model")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_brands', function (Blueprint $table) {
            $table->dropColumn("model");
            $table->dropColumn("article");
        });
    }
};
