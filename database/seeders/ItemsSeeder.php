<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        Item::query()->insert([
            ['name' => 'Куртка на утепляющей прокладке', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Костюм для защиты от механических воздействий', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Обувь специальная для защиты от механических воздействий', 'category_id' => 3, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Перчатки для защиты от механических воздействий', 'category_id' => 4, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Головной убор для защиты от общих производственных загрязнений', 'category_id' => 2, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Защитная каска', 'category_id' => 2, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Очки защитные открытые, с боковой защитой', 'category_id' => 9, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Наушники противошумные', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'СИЗОД противоаэрозольное', 'category_id' => 8, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Перчатки с полимерным покрытием', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Перчатки трикотажные с точечным полимерным покрытием', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Очки защитные, затемненные, открытые с боковой защитой', 'category_id' => 9, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Фартук от механических воздействий', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Жилет сигнальный повышенной видимости', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Плащ для защиты от воды', 'category_id' => 1, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Противошумные вкладыши (беруши)', 'category_id' => 7, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Противогазоаэрозольные фильтрующие полумаски', 'category_id' => 8, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Безлямочный предохранительный пояс', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Перчатки для от воды и нетоксичных веществ', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Мыло туалетное', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Очищающий гель', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Крем регенерирующий', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Крем защитный универсальный', 'category_id' => 6, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Перчатки с защитным покрытием, морозостойкие с шерстяными вкладышами', 'category_id' => 5, 'description' => null, 'brand' => null, 'model' => null, 'norm_clause' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
