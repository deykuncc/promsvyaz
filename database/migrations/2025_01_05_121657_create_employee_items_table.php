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
        Schema::create('employee_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->float('quantity');
            $table->unsignedTinyInteger('quantity_type');
            $table->boolean('received')->default(false);
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('usage_months')->nullable()->default(null);
            $table->timestamp('issued_date')->nullable()->default(null);
            $table->timestamp('expiry_date')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_items');
    }
};
