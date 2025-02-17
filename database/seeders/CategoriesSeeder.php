<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::query()->insert([
            ['name' => 'Одежда специальная защитная', 'name_eng' => 'clothes'], // 1
            ['name' => 'Средства защиты головы', 'name_eng' => 'hats'], // 2
            ['name' => 'Средства защиты ног', 'name_eng' => 'shoes'], // 3
            ['name' => 'Средства защиты рук', 'name_eng' => 'hands'], // 4
            ['name' => 'Перчатки', 'name_eng' => 'hands'], // 5
            ['name' => 'Средства защиты рук, смывающие', 'name_eng' => 'clear'], // 6
            ['name' => 'Средства защиты органов слуха', 'name_eng' => 'others'], // 7
            ['name' => 'Средства защиты органов дыхания', 'name_eng' => 'others'], // 8
            ['name' => 'Средства защиты глаз', 'name_eng' => 'others'], // 9
            ['name' => 'Прочее', 'name_eng' => 'others'], // 10
        ]);
    }
}
