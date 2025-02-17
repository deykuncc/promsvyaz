<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionsSeeder extends Seeder
{
    public function run(): void
    {
        Profession::query()->insert([
            ['name' => 'Оператор станков с программным управлением 3 - разряда', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Электромонтер по ремонту и обслуживанию электрооборудования 3 - разряда', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Оператор станков с программным управлением 4 - разряда', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Слесарь-сантехник', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Электромонтер 6 - разряда', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Главный энергетик - начальник участка', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Заместитель главного энергетика - начальника участка', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Уборщик территорий', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Уборщик территорий (дворник)', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Токарь 3 - разряда', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ]);
    }
}
