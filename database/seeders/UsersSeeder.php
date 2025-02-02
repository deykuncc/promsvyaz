<?php

namespace Database\Seeders;

use App\Models\Category;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->insert([
            // yprom819zz
            [
                'login' => 'yzaytsev',
                'first_name' => 'Юрий',
                'last_name' => 'Зайцев',
                'middle_name' => 'Николаевич',
                'password' => '$2y$12$c5rIZSfzHHjaWO16LSs2yuMpk6NLGCp3SdNxkS5AOpyfNaYXPOmeu',
                'role_id' => 1
            ],
        ]);
    }
}
