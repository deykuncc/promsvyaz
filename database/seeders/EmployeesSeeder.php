<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    public function run(): void
    {
        Employee::query()->insert([
            [
                'last_name' => 'Курашина', 'first_name' => 'Елена', 'middle_name' => 'Николаевна', 'profession_id' => 1, 'department_id' => 6,
                'gender_id' => 2, 'height' => 146, 'external_id' => 1108,
                'clothes_size_id' => 4, 'shoes_size_id' => 22, 'hats_size_id' => 11,
                'employment_date' => now(), 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null,
            ],
        ]);
    }
}
