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
            ['name' => 'Одежда'],
            ['name' => 'Дерматология'],
            ['name' => 'Прочее'],
        ]);
    }
}
