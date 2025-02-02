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
        Schema::create('profession_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profession_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profession_items');
    }
};
