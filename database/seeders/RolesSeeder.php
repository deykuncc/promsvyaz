<?php

namespace Database\Seeders;

use App\Models\Category;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::query()->insert([
            ['name' => 'Администратор'],
            ['name' => 'Сотрудник'],
        ]);
    }
}
