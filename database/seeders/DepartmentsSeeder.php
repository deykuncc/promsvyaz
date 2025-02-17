<?php

namespace Database\Seeders;


use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::query()->insert([
            ['name' => 'Руководители №29', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Энергетический №7', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Отдел капитального строительства №6', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Служба главного инженера №59', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Ремонтно-механический участок №34', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Механический цех №2 участок №1', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Механический цех №2 участок №2', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Монтажная группа №46', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Сборочный цех №4', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Сборочный цех №3', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Заготовительный цех №1', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Сварочный цех №4', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Автотранспортный участок №5', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Отдел технического контроля №47', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Бюро входного контроля', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Лаборатория по испытаниям и неразрушающему контролю', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Отдел кадров №25', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Отдел труда и заработной платы', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Административно-хозяйственная группа №24', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Группа информационных технологий', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Отдел сбыта №21', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Склад готовой продукции №10', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ]);
    }
}
