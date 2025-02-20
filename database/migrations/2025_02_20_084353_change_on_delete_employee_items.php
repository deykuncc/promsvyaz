<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employee_items', function (Blueprint $table) {
            // Удаляем существующий внешний ключ
            $table->dropForeign('employee_items_item_id_foreign');

            // Добавляем новый внешний ключ с onDelete('cascade')
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('employee_items', function (Blueprint $table) {
            // Откатываем изменения: удаляем новый внешний ключ
            $table->dropForeign('employee_items_item_id_foreign');

            // Возвращаем старый внешний ключ с onDelete('set null')
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('set null');
        });
    }
};
