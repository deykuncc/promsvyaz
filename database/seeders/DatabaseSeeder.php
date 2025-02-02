<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genderSeeder = new GenderSeeder();
        $genderSeeder->run();

        $sizeSeeder = new SizeSeeder();
        $sizeSeeder->run();

        $categoriesSeeder = new CategoriesSeeder();
        $categoriesSeeder->run();

        $rolesSeeder = new RolesSeeder();
        $rolesSeeder->run();

        $usersSeeder = new UsersSeeder();
        $usersSeeder->run();
    }
}
