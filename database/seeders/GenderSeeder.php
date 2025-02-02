<?php

namespace Database\Seeders;

use App\Models\Gender;

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Gender::query()->insert([
            ['name' => 'male'],
            ['name' => 'female'],
        ]);
    }
}
