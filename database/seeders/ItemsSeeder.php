<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        Item::query()->insert([
            ['name' => 'Куртка на утепляющей прокладке', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Костюм для защиты от механических воздействий', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Обувь специальная для защиты от механических воздействий', 'category_id' => 3, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Перчатки для защиты от механических воздействий', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Головной убор для защиты от общих производственных загрязнений', 'category_id' => 2, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Защитная каска', 'category_id' => 2, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Очки защитные открытые, с боковой защитой', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Наушники противошумные', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'СИЗОД противоаэрозольное', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Перчатки с полимерным покрытием', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Перчатки трикотажные с точечным полимерным покрытием', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Очки защитные, затемненные, открытые с боковой защитой', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Фартук от механических воздействий', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Жилет сигнальный повышенной видимости', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Плащ для защиты от воды', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Противошумные вкладыши (беруши)', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Противогазоаэрозольные фильтрующие полумаски', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Безлямочный предохранительный пояс', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Перчатки для от воды и нетоксичных веществ', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Мыло туалетное', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Очищающий гель', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Крем регенерирующий', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Крем защитный универсальный', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Перчатки с защитным покрытием, морозостойкие с шерстяными вкладышами', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ]);
    }
}
