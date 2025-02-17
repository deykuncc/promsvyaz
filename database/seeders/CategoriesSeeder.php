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
            ['name' => 'Одежда', 'name_eng' => 'clothes'],
            ['name' => 'Головной убор', 'name_eng' => 'hats'],
            ['name' => 'Обувь', 'name_eng' => 'shoes'],
            ['name' => 'Перчатки', 'name_eng' => 'hands'],
            ['name' => 'Средства защиты рук, смывающие', 'name_eng' => 'clear'],
            ['name' => 'Прочее', 'name_eng' => 'others'],
        ]);
    }
}
